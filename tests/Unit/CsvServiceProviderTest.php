<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Unit;

use InnovatorJapan\LaravelCsv\Exporter;
use InnovatorJapan\LaravelCsv\Tests\TestCase;

class CsvServiceProviderTest extends TestCase
{
    public function testExporterCanBeResolved()
    {
        $exporter = app(Exporter::class);
        $this->assertThat($exporter, $this->isInstanceOf(Exporter::class));
    }
}
