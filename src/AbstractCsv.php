<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use Illuminate\Database\Query\Builder;
use InnovatorJapan\LaravelCsv\Contracts\ExportedData;

/**
 * Class Csv
 */
abstract class AbstractCsv implements ExportedData
{
    /**
     * @var int
     */
    protected $chunkCount = 1000;

    /**
     * {@inheritdoc}
     */
    abstract public function query(): Builder;

    /**
     * {@inheritdoc}
     */
    public function chunkCount(): int
    {
        return $this->chunkCount;
    }

    /**
     * {@inheritdoc}
     */
    public function format($record): array
    {
        return (array)$record;
    }
}
