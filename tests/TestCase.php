<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests;

use InnovatorJapan\LaravelCsv\CsvServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getPackageProviders($app)
    {
        return [
            CsvServiceProvider::class,
        ];
    }
}
