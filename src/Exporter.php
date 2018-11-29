<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Contracts\Routing\ResponseFactory;
use InnovatorJapan\LaravelCsv\Contracts\ExportedData;
use InnovatorJapan\LaravelCsv\Contracts\Exporter as ExporterInterface;
use InnovatorJapan\LaravelCsv\Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;
use TypeError;

/**
 * Class Exporter
 */
class Exporter implements ExporterInterface
{
    /**
     * @var Writer
     */
    protected $writer;

    /**
     * @var Factory
     */
    protected $filesystem;

    /**
     * @param Writer $writer
     * @param Factory $filesystem
     */
    public function __construct(
        Writer $writer,
        Factory $filesystem
    ) {
        $this->writer = $writer;
        $this->filesystem = $filesystem;
    }

    /**
     * {@inheritdoc}
     */
    public function download($csv, string $filename = 'export.csv'): StreamedResponse
    {
        if (!($csv instanceof ExportedData)) {
            $expected = ExportedData::class;
            $actual = get_class($csv);
            $message = "\$exporter must implement interface {$expected}, {$actual} given.";
            throw new TypeError($message);
        }

        $callback = function () use ($csv) {
            $this->writer->streamOutput($csv);
        };
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        return app(ResponseFactory::class)->streamDownload($callback, $filename, $headers);
    }
}
