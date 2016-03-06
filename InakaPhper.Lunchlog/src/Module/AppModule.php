<?php

namespace InakaPhper\Lunchlog\Module;

use BEAR\Package\PackageModule;
use InakaPhper\Lunchlog\Entity\Menu;
use InakaPhper\Lunchlog\Entity\Shop;
use InakaPhper\Lunchlog\Module\Doctrine\DoctrineModule;
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
        $this->install(new DoctrineModule);
        $this->install(new DbAppPackage($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_READ']));

        // Entity
        $this->bind('InakaPhper\Lunchlog\Entity\Shop')->annotatedWith("shop")->toInstance(new Shop());
        $this->bind('InakaPhper\Lunchlog\Entity\Menu')->annotatedWith("menu")->toInstance(new Menu());
    }
}
