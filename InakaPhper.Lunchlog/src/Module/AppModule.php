<?php

namespace InakaPhper\Lunchlog\Module;

use BEAR\AppMeta\AppMeta;
use BEAR\Package\PackageModule;
use Dotenv\Dotenv;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\Di\AbstractModule;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        // app meta
        $appMeta = new AppMeta('InakaPhper\Lunchlog');
        // dot env
        $dotenv = new Dotenv($appMeta->appDir);
        $dotenv->load();
        $dotenv->required(['PDO_DSN', 'PDO_USER', 'PDO_PASSWORD']);

        $this->install(new PackageModule);
        $this->install(new AuraSqlModule(getenv('PDO_DSN'), getenv('PDO_USER'), getenv('PDO_PASSWORD')));
    }
}
