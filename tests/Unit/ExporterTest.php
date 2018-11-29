<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Unit;

use InnovatorJapan\LaravelCsv\Exporter;
use InnovatorJapan\LaravelCsv\Tests\Stubs\Database\User;
use InnovatorJapan\LaravelCsv\Tests\Stubs\UserCsv;
use InnovatorJapan\LaravelCsv\Tests\TestCase;
use Symfony\Component\HttpFoundation\StreamedResponse;
use TypeError;

class ExporterTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../Stubs/Database/Migrations');
        $this->withFactories(__DIR__ . '/../Stubs/Database/Factories');

        factory(User::class)->times(10)->create();
    }

    public function testDownloadable()
    {
        $csv = new UserCsv();
        $filename = 'test.csv';
        $response = app(Exporter::class)->download($csv, $filename);
        $this->assertThat($response, $this->isInstanceOf(StreamedResponse::class));

        $expected = "attachment; filename={$filename}";
        $actual = $response->headers->get('Content-Disposition');
        $this->assertThat($actual, $this->identicalTo($expected));

        ob_start();
        $response->sendContent();
        $content = ob_get_contents();
        ob_end_clean();
        $this->assertThat($content, $this->logicalNot($this->identicalTo('')));
    }

    /**
     * @expectedException TypeError
     */
    public function testCsvMustImplementsExportedData()
    {
        $csv = (object)[];
        app(Exporter::class)->download($csv, 'test.csv');
    }
}
