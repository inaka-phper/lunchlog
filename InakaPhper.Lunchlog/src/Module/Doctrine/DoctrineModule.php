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
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $dbname;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;


    /**
     * DoctrineModule constructor.
     * @param $host
     * @param $dbname
     * @param $user
     * @param $password
     */
    public function __construct($host, $dbname, $user, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $conn = [
            'dbname' => $this->dbname,
            'user' => $this->user,
            'password' => $this->password,
            'host' => $this->host,
            'driver' => 'pdo_mysql',
            'charset' => 'utf8',
        ];
        $this->bind()->annotatedWith("master_db")->toInstance($conn);

        $this->bind('Doctrine\ORM\EntityManager')->annotatedWith("manager")->toProvider('InakaPhper\Lunchlog\Module\Doctrine\Provider\DoctrineORMProvider');

    }
}