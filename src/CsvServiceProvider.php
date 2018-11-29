<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use Illuminate\Support\ServiceProvider;
use InnovatorJapan\LaravelCsv\Exporter;
use InnovatorJapan\LaravelCsv\Writer;

/**
 * Class CsvServiceProvider
 */
class CsvServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton(Exporter::class, function () {
            return new Exporter(
                $this->app->make(Writer::class),
                $this->app->make('filesystem')
            );
        });
    }
}
