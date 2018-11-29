<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Stubs;

use Illuminate\Database\Query\Builder;
use InnovatorJapan\LaravelCsv\Contracts\ExportedData;
use InnovatorJapan\LaravelCsv\Exportable;
use InnovatorJapan\LaravelCsv\Tests\Stubs\Database\User;

class Exporter implements ExportedData
{
    use Exportable;

    /**
     * {@inheritdoc}
     */
    public function useBom(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function header(): array
    {
        return [];
    }

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
