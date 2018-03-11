<?php

namespace App\Config;

use App\Config\Loaders\ILoader;

class Config
{
    protected $config = [];

    public function load(array $loaders)
    {
        foreach ($loaders as $loader) {
            if ($loader instanceof ILoader) {
                $this->config = array_merge($this->config, $loader->parse());
            }
        }
        return $this;
    }
}
