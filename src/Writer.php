<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use Exception;
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
        $path = 'php://output';
        $stream = fopen($path, 'w');
        if ($stream === false) {
            throw new Exception(sprintf('failed to open stream: `%s`', $path));
        }

        $writer = BaseWriter::createFromStream($stream);
        // adding the stream filter to force enclosure
        EncloseField::addTo($writer, "\t\x1f");

        if ($csv->useBom()) {
            fwrite($stream, BaseWriter::BOM_UTF8);
        }

        $header = $csv->header();
        if ($header !== []) {
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
                    continue;
                }
                $writer->insertOne($row);
            }
        });
    }
}
