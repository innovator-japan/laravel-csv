<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Stubs;

use Illuminate\Database\Query\Builder;
use InnovatorJapan\LaravelCsv\Exportable;
use InnovatorJapan\LaravelCsv\Exporter as ExporterInterface;
use InnovatorJapan\LaravelCsv\Tests\Stubs\User;

class Exporter implements ExporterInterface
{
    use Exportable;

    /**
     * {@inheritdoc}
     */
    public function query(): Builder
    {
        return User::query()->getQuery();
    }

    /**
     * {@inheritdoc}
     */
    public function chunkCount(): int
    {
        return 1000;
    }

    /**
     * {@inheritdoc}
     */
    public function format($record): array
    {
        return (array)$record;
    }
}
