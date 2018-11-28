<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests;

use InnovatorJapan\LaravelCsv\Csv;
use InnovatorJapan\LaravelCsv\Tests\TestCase;

class CsvServiceProviderTest extends TestCase
{
    public function testCsvCanBeResolved()
    {
        $csv = app(Csv::class);
        $this->assertThat($csv, $this->isInstanceOf(Csv::class));
    }
}
