<?php

namespace InakaPhper\Lunchlog\Module;

use BEAR\Package\PackageModule;
use InakaPhper\Lunchlog\Entity\Shop;
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
        $this->install(new AuraSqlModule(getenv('PDO_DSN'), getenv('PDO_USER'), getenv('PDO_PASSWORD')));

        $this->bind('Doctrine\ORM\EntityManager')->annotatedWith("manager")->toProvider('InakaPhper\Lunchlog\Module\Provider\DoctrineORMProvider');

        // Entity
        $this->bind('InakaPhper\Lunchlog\Entity\Shop')->annotatedWith("shop")->toInstance(new Shop());
    }
}
