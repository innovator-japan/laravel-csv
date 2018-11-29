<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv\Contracts;

use InnovatorJapan\LaravelCsv\Contracts\ExportedData;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * interface Writer
 */
interface Writer
{
    /**
     * @param ExportedData $csv
     * @return void
     */
    public function streamOutput(ExportedData $csv);
}
