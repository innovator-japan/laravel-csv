<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests;

use InnovatorJapan\LaravelCsv\Csv;
use InnovatorJapan\LaravelCsv\Tests\Stubs\Exporter;
use InnovatorJapan\LaravelCsv\Tests\TestCase;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvTest extends TestCase
{
    public function testDownloadable()
    {
        $exporter = new Exporter();
        $filename = 'test.csv';
        $response = app(Csv::class)->download($exporter, $filename);
        $this->assertThat($response, $this->isInstanceOf(StreamedResponse::class));

        $expected = "attachment; filename={$filename}";
        $actual = $response->headers->get('Content-Disposition');
        $this->assertThat($actual, $this->identicalTo($expected));
    }
}
