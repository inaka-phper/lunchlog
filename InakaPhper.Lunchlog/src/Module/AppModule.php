<?php

namespace InakaPhper\Lunchlog\Module;

use BEAR\Package\PackageModule;
use InakaPhper\Lunchlog\Entity\Shop;
use josegonzalez\Dotenv\Loader as Dotenv;
use Koriym\DbAppPackage\DbAppPackage;
use Ray\Di\AbstractModule;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        Dotenv::load([
            'filepath' => dirname(dirname(__DIR__)) . '/.env',
            'expect' => ['DB_DSN', 'DB_USER', 'DB_PASS'],
            'toEnv' => true
        ]);

        $this->install(new PackageModule);
        $this->install(new DbAppPackage($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_READ']));

        $this->bind('Doctrine\ORM\EntityManager')->annotatedWith("manager")->toProvider('InakaPhper\Lunchlog\Module\Provider\DoctrineORMProvider');

        // Entity
        $this->bind('InakaPhper\Lunchlog\Entity\Shop')->annotatedWith("shop")->toInstance(new Shop());
    }
}
