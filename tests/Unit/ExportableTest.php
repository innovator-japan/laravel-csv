<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Tests\Unit;

use InnovatorJapan\LaravelCsv\Tests\Stubs\Exporter;
use InnovatorJapan\LaravelCsv\Tests\TestCase;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportableTest extends TestCase
{
    public function testDownloadable()
    {
        $exporter = new Exporter();
        $response = $exporter->download();
        $this->assertThat($response, $this->isInstanceOf(StreamedResponse::class));
    }
}
