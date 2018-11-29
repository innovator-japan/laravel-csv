<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Contracts;

use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * interface Exporter
 */
interface Exporter
{
    /**
     * @param object $csv
     * @param string $filename
     * @return StreamedResponse
     */
    public function download($csv, string $filename): StreamedResponse;
}
