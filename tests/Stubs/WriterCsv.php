<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Stubs;

use Illuminate\Database\Query\Builder;
use InnovatorJapan\LaravelCsv\AbstractCsv;
use InnovatorJapan\LaravelCsv\Tests\Stubs\Database\User;

class WriterCsv extends AbstractCsv
{
    /**
     * {@inheritdoc}
     */
    protected $chunkCount = 10;

    /**
     * {@inheritdoc}
     */
    protected $useBom = true;

    /**
     * {@inheritdoc}
     */
    public function header(): array
    {
        return [
            'header-ID',
            'header-NAME',
            'header-EMAIL',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function query(): Builder
    {
        return User::orderBy('id')->getQuery();
    }

    /**
     * {@inheritdoc}
     */
    public function format($record): array
    {
        return [
            [
                'first-' . $record->id,
                'first-' . $record->name,
                'first-' . $record->email,
            ],
            [
                'second-' . $record->id,
                'second-' . $record->name,
                'second-' . $record->email,
            ],
        ];
    }
}
