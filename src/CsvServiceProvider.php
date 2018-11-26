<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(Csv::class, function () {
            return new Csv(
                $this->app->make('filesystem')
            );
        });
    }
}
