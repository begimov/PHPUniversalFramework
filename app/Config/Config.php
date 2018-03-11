<?php

namespace App\Config;

use App\Config\Loaders\ILoader;

class Config
{
    protected $config = [];
    protected $cache = [];

    public function load(array $loaders)
    {
        foreach ($loaders as $loader) {
            if ($loader instanceof ILoader) {
                $this->config = array_merge($this->config, $loader->parse());
            }
        }
        return $this;
    }

    public function get($key, $default = null)
    {
        if ($this->existsInCache($key)) {
            return $this->getFromCache($key);
        }

        $this->addToCache(
            $key, 
            $propValue = $this->getConfigProp($this->config, explode('.', $key))
        );

        return $propValue ?? $default;
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

        return;
    }

    protected function existsInCache($key)
    {
        return isset($this->cache[$key]);
    }

    protected function getFromCache($key)
    {
        return $this->cache[$key];
    }

    protected function addToCache($key, $value)
    {
        $this->cache[$key] = $value;
    }
}
