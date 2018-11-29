<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Unit;

use InnovatorJapan\LaravelCsv\Exporter;
use InnovatorJapan\LaravelCsv\Tests\Stubs\Csv;
use InnovatorJapan\LaravelCsv\Tests\TestCase;
use Symfony\Component\HttpFoundation\StreamedResponse;
use TypeError;

class ExporterTest extends TestCase
{
    public function testDownloadable()
    {
        $csv = new Csv();
        $filename = 'test.csv';
        $response = app(Exporter::class)->download($csv, $filename);
        $this->assertThat($response, $this->isInstanceOf(StreamedResponse::class));

        $expected = "attachment; filename={$filename}";
        $actual = $response->headers->get('Content-Disposition');
        $this->assertThat($actual, $this->identicalTo($expected));
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
