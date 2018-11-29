<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Unit;

use InnovatorJapan\LaravelCsv\Tests\Stubs\Database\User;
use InnovatorJapan\LaravelCsv\Tests\Stubs\WriterCsv;
use InnovatorJapan\LaravelCsv\Tests\TestCase;
use InnovatorJapan\LaravelCsv\Writer;

class WriterTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../Stubs/Database/Migrations');
        $this->withFactories(__DIR__ . '/../Stubs/Database/Factories');

        factory(User::class)->times(10)->create();
    }

    public function testStreamOutputable()
    {
        $csv = new WriterCsv();
        $writer = new Writer();

        ob_start();
        $writer->streamOutput($csv);
        $content = ob_get_contents();
        ob_end_clean();

        $this->assertThat($content, $this->logicalNot($this->identicalTo('')));
    }
}
