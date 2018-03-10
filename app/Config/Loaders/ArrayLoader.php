<?php

namespace App\Config\Loaders;

class ArrayLoader implements ILoader
{
    protected $files;

    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function parse()
    {
        $parsed = [];

        foreach ($this->files as $namespace => $path) {
            try {
                $parsed[$namespace] = require $path;
            } catch(\Exception $e) {
                //
            }
        }
    }
}
