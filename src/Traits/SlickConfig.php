<?php


namespace CImrie\Slick\Traits;


trait SlickConfig
{
    protected function getConfig($key = null, $default = null)
    {
        $key = $key !== null ? '.' . $key : null;

        return $this->getGlobalConfig($this->getConfigName() . $key, $default);
    }

    protected function getGlobalConfig($key = null, $default = null)
    {
        $config = $this->app->make('config')->all();

        if ($key) {
            $config = array_get($config, $key, $default);
        }

        return $config;
    }

    public function getConfigName()
    {
        return 'odm';
    }
}