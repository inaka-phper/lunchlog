<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/02/11
 * Time: 0:30
 */

namespace InakaPhper\Lunchlog\Module\Provider;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Ray\Di\ProviderInterface;

class DoctrineORMProvider implements ProviderInterface
{
    /**
     * Get object
     *
     * @return mixed
     */
    public function get()
    {
        $paths = [__DIR__ . '/../../Entity'];
        $isDevMode = false;

        $config = Setup::createAnnotationMetadataConfiguration(
            $paths, $isDevMode
        );
        $conn = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'host' => $_ENV['DB_HOST'],
            'driver' => 'pdo_mysql',
            'charset' => 'utf8',
        ];

        return EntityManager::create($conn, $config);
    }
}