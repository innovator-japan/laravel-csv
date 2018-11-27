<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Filesystem\FilesystemManager;
use InnovatorJapan\LaravelCsv\Csv;
use PHPUnit\Framework\TestCase;

class CsvServiceProviderTest extends TestCase
{
    public function testCsvCanBeResolved()
    {
        $csv = new Csv(new FilesystemManager(new Application()));
        $this->assertInstanceOf(Csv::class, $csv);
    }
}
