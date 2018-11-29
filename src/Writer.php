<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use InnovatorJapan\LaravelCsv\Contracts\Writer as WriterInterface;
use InnovatorJapan\LaravelCsv\Contracts\ExportedData;
use League\Csv\EncloseField;
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
        // adding the stream filter to force enclosure
        EncloseField::addTo($writer, "\t\x1f");

        if ($csv->useBom()) {
            fwrite($stream, BaseWriter::BOM_UTF8);
        }

        $header = $csv->header();
        if (!empty($header)) {
            $writer->addValidator(function (array $row) use ($header) {
                return count($row) === count($header);
            }, 'row_must_contain_as_many_fields_as_header');
            $writer->insertOne($header);
        }

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
