<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use InnovatorJapan\LaravelCsv\Contracts\Writer as WriterInterface;
use InnovatorJapan\LaravelCsv\Contracts\ExportedData;
use League\Csv\Writer as BaseWriter;

/**
 * Class Writer
 */
class Writer implements WriterInterface
{
    /**
     * {@inheritdoc}
     */
    public function streamOutput(ExportedData $csv)
    {
        $stream = fopen('php://output', 'w');
        $writer = BaseWriter::createFromStream($stream);
        $csv->query()->chunk($csv->chunkCount(), function ($chunk) use ($csv, $writer) {
            foreach ($chunk as $record) {
                $row = $csv->format($record);
                if (is_array(reset($row))) {
                    $writer->insertAll($row);
                } else {
                    $writer->insertOne($row);
                }
            }
        });
    }
}
