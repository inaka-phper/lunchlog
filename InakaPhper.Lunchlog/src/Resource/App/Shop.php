<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/02/11
 * Time: 21:14
 */

namespace InakaPhper\Lunchlog\Resource\App;


use BEAR\Resource\ResourceObject;
use Doctrine\ORM\EntityManager;
use InakaPhper\Lunchlog\Entity\Shop as Entity;
use Ray\Di\Di\Inject;

class Shop extends ResourceObject
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    private $shop;

    /**
     * Shop constructor.
     * @param EntityManager $entityManager
     * @param Entity $shop
     * @Inject
     */
    public function __construct(EntityManager $entityManager, Entity $shop)
    {
        $this->entityManager = $entityManager;
        $this->shop = $shop;
    }

    /**
     * find of shop resource.
     *
     * @param int $id
     * @return ResourceObject
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function onGet(int $id): ResourceObject
    {
        $shop = $this->entityManager->find(get_class($this->shop), $id);
        $this['shop'] = $shop->toArray();

        return $this;
    }

    /**
     * shop create.
     *
     * @param string $name
     * @param string $address
     * @return ResourceObject
     */
    public function onPost(string $name, string $address): ResourceObject
    {
        $this->shop->setName($name);
        $this->shop->setAddress($address);
        $this->shop->setCreated((new \DateTime('now'))->format('Y-m-d H:i:s'));

        $this->entityManager->persist($this->shop);
        $this->entityManager->flush();

        $this->headers['Location'] = '/shop?id=' . $this->shop->getId();
        $this->code = 201;

        return $this;
    }

    /**
     * shop update.
     *
     * @param int $id
     * @param string $name
     * @param string $address
     * @return ResourceObject
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function onPut(int $id, string $name, string $address): ResourceObject
    {
        $this->shop = $this->entityManager->find(get_class($this->shop), $id);
        $this->shop->setName($name);
        $this->shop->setAddress($address);

        $this->entityManager->persist($this->shop);
        $this->entityManager->flush();

        $this->headers['Location'] = '/shop?id=' . $this->shop->getId();
        $this->code = 204;

        return $this;
    }

    /**
     * delete shop.
     *
     * @param int $id
     * @return ResourceObject
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function onDelete(int $id): ResourceObject
    {
        $this->shop = $this->entityManager->find(get_class($this->shop), $id);

        $this->entityManager->remove($this->shop);
        $this->entityManager->flush();

        $this->code = 204;

        return $this;
    }
}