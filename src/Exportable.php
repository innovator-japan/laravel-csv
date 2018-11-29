<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use InnovatorJapan\LaravelCsv\Exporter;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Trait Exportable
 */
trait Exportable
{
    /**
     * Create a streamed response for a given file.
     *
     * @param string $filename
     * @return StreamedResponse
     */
    public function download(string $filename = 'export.csv'): StreamedResponse
    {
        return app(Exporter::class)->download($this, $filename);
    }
}
