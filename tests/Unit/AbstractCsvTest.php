<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Unit;

use Illuminate\Database\Query\Builder;
use InnovatorJapan\LaravelCsv\Tests\Stubs\Database\User;
use InnovatorJapan\LaravelCsv\Tests\Stubs\MinimumCsv;
use InnovatorJapan\LaravelCsv\Tests\Stubs\OverrideCsv;
use InnovatorJapan\LaravelCsv\Tests\TestCase;
use stdClass;

class AbstractCsvTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../Stubs/Database/Migrations');
        $this->withFactories(__DIR__ . '/../Stubs/Database/Factories');

        factory(User::class)->times(10)->create();
    }

    public function testDefaultMethodIsCollect()
    {
        $csv = new MinimumCsv();
        $record = (object)[
            'foo' => 'FOO',
            'bar' => 'BAR',
        ];
        $formatted = $csv->format($record);

        $this->assertThat($csv->chunkCount(), $this->identicalTo(1000));
        $this->assertThat($formatted, $this->arrayHasKey('foo'));
        $this->assertThat($formatted['foo'], $this->identicalTo('FOO'));
        $this->assertThat($formatted, $this->arrayHasKey('bar'));
        $this->assertThat($formatted['bar'], $this->identicalTo('BAR'));
    }

    public function testMethodIsOverridden()
    {
        $csv = new OverrideCsv();
        $record = (object)[
            'foo' => 'FOO',
            'bar' => 'BAR',
        ];
        $formatted = $csv->format($record);

        $this->assertThat($csv->query(), $this->isInstanceOf(Builder::class));
        $this->assertThat($csv->query()->first(), $this->isInstanceOf(stdClass::class));
        $this->assertThat($csv->chunkCount(), $this->identicalTo(10));
        $this->assertThat($formatted, $this->arrayHasKey('foo'));
        $this->assertThat($formatted['foo'], $this->identicalTo('formattedFOO'));
        $this->assertThat($formatted, $this->arrayHasKey('bar'));
        $this->assertThat($formatted['bar'], $this->identicalTo('formattedBAR'));
    }
}
