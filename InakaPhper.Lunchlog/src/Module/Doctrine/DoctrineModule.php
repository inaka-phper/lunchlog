<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/03/07
 * Time: 0:28
 */

namespace InakaPhper\Lunchlog\Module\Doctrine;


use Ray\Di\AbstractModule;

class DoctrineModule extends AbstractModule
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $conn = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'host' => $_ENV['DB_HOST'],
            'driver' => 'pdo_mysql',
            'charset' => 'utf8',
        ];
        $this->bind()->annotatedWith("master_db")->toInstance($conn);

        $this->bind('Doctrine\ORM\EntityManager')->annotatedWith("manager")->toProvider('InakaPhper\Lunchlog\Module\Doctrine\Provider\DoctrineORMProvider');

    }
}