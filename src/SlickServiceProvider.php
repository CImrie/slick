<?php


namespace CImrie\Slick;


use CImrie\ODM\Configuration\MetaData\Metadata;
use CImrie\ODM\DocumentManagerFactory;
use CImrie\ODM\OdmServiceProvider;
use CImrie\Slick\Mapping\SlickDriver;
use CImrie\Slick\Traits\SlickConfig;
use Illuminate\Support\ServiceProvider;

class SlickServiceProvider extends ServiceProvider
{
    use SlickConfig;

    public function boot()
    {
    }

    public function register()
    {
        if (!$this->app->bound(DocumentManagerFactory::class)) {
            $this->app->register(OdmServiceProvider::class);
        }

        if(!array_search(SlickDriver::class, $drivers = $this->getConfig('metadata_drivers')))
        {
            $this->app->tag(SlickDriver::class, Metadata::class);
            $this->app->make('config')->set($this->getConfigName() . ".metadata_drivers", array_merge($drivers, [SlickDriver::class]));
        }
    }
}