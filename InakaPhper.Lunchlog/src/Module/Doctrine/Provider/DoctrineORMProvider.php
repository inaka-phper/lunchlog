<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/02/11
 * Time: 0:30
 */

namespace InakaPhper\Lunchlog\Module\Doctrine\Provider;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;
use Ray\Di\ProviderInterface;

class DoctrineORMProvider implements ProviderInterface
{
    private $masterDb;

    /**
     * DoctrineORMProvider constructor.
     *
     * @param array $master_db
     *
     * @Inject
     * @Named("master_db=master_db")
     */
    public function __construct(array $master_db)
    {
        $this->masterDb = $master_db;
    }

    /**
     * Get object
     *
     * @return mixed
     */
    public function get()
    {
        $paths = [__DIR__ . '/../../../Entity'];
        $isDevMode = false;

        $config = Setup::createAnnotationMetadataConfiguration(
            $paths, $isDevMode
        );

        return EntityManager::create($this->masterDb, $config);
    }
}