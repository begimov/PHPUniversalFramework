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

    public function get($key)
    {
        $keys = explode('.', $key);
        return $this->getConfigProp($this->config, $keys);
    }

    protected function getConfigProp($config, $keys)
    {
        if (!is_array($config) || empty($keys)) {
            return $config;
        }

        $key = array_shift($keys);

        if (isset($config[$key])) {
            return $this->getConfigProp($config[$key], $keys);
        }

        return false;
    }
}
