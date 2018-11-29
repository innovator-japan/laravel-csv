<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Stubs;

use Illuminate\Database\Query\Builder;
use InnovatorJapan\LaravelCsv\AbstractCsv;
use InnovatorJapan\LaravelCsv\Tests\Stubs\Database\User;

class UserCsv extends AbstractCsv
{
    /**
     * {@inheritdoc}
     */
    protected $chunkCount = 10;

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
            $record->id,
            $record->name,
            $record->email,
        ];
    }
}
