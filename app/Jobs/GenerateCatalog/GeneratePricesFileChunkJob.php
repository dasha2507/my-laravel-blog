<?php

namespace App\Jobs\GenerateCatalog;

class GeneratePricesFileChunkJob extends AbstractJob
{
    protected $chunk;
    protected $fileNum;

    public function __construct($chunk, $fileNum)
    {
        parent::__construct();
        $this->chunk = $chunk;
        $this->fileNum = $fileNum;
    }
}
