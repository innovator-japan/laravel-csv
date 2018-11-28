<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Contracts\Routing\ResponseFactory;
use InnovatorJapan\LaravelCsv\Exporter;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;
use TypeError;

/**
 * Class Csv
 */
class Csv
{
    /**
     * @var Factory
     */
    protected $filesystem;

    /**
     * @param Factory $filesystem
     */
    public function __construct(Factory $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Create a streamed response for a given file.
     *
     * @param Exporter $exporter
     * @param string $filename
     * @return StreamedResponse
     */
    public function download($exporter, string $filename): StreamedResponse
    {
        if (!($exporter instanceof Exporter)) {
            $expected = Exporter::class;
            $actual = get_class($exporter);
            $message = "\$exporter must implement interface {$expected}, {$actual} given.";
            throw new TypeError($message);
        }

        $callback = function () use ($exporter) {
            $stream = fopen('php://output', 'w');
            $writer = Writer::createFromStream($stream);
            $exporter->query()->chunk($exporter->chunkCount(), function ($chunk) use ($exporter, $writer) {
                foreach ($chunk as $record) {
                    $row = $exporter->format($record);
                    if (is_array(reset($row))) {
                        $writer->insertAll($row);
                    } else {
                        $writer->insertOne($row);
                    }
                }
            });
        };
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        return app(ResponseFactory::class)->streamDownload($callback, $filename, $headers);
    }
}
