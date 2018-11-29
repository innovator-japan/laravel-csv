<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Contracts;

use Illuminate\Database\Query\Builder;

/**
 * interface ExportedData
 */
interface ExportedData
{
    /**
     * @return Builder
     */
    public function query(): Builder;

    /**
     * @return int
     */
    public function chunkCount(): int;

    /**
     * @param object $record
     * @return array
     */
    public function format($record): array;
}
