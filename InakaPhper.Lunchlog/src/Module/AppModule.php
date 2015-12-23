<?php

namespace MyVendor\MyProject\Module;

use BEAR\Package\PackageModule;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\Di\AbstractModule;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new PackageModule);
        $this->install(new AuraSqlModule('mysql:host=localhost;dbname=homestead', 'homestead', 'secret'));
    }
}
