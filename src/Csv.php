<?php

declare(strict_types=1);

namespace InnovatorJapan\LaravelCsv;

use Illuminate\Contracts\Filesystem\Factory;

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
}
