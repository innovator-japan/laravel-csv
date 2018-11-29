<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Stubs;

use Illuminate\Database\Query\Builder;
use InnovatorJapan\LaravelCsv\AbstractCsv;
use InnovatorJapan\LaravelCsv\Tests\Stubs\User;

class MinimumCsv extends AbstractCsv
{
    /**
     * {@inheritdoc}
     */
    public function query(): Builder
    {
        return User::query()->getQuery();
    }
}
