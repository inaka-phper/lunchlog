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
use InakaPhper\Lunchlog\Entity\Menu as Entity;
use Ray\Di\Di\Inject;
use Ray\Di\Di\Named;

class Menu extends ResourceObject
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Entity
     */
    private $menu;

    /**
     * Menu constructor.
     * @param EntityManager $entityManager
     * @param Entity $menu
     * @Inject
     * @Named("entityManager=manager, menu=menu")
     */
    public function __construct(EntityManager $entityManager, Entity $menu)
    {
        $this->entityManager = $entityManager;
        $this->menu = $menu;
    }

    /**
     * find of menu resource.
     *
     * @param int $id
     * @param int $shop_id
     * @return ResourceObject
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function onGet(int $id = null, int $shop_id = null): ResourceObject
    {
        if (is_null($id)) {
            $conditions = [];

            if (!is_null($shop_id)) {
                $conditions['shop_id'] = $shop_id;
            }

            $menu = $this->entityManager->getRepository(get_class($this->menu))->findBy($conditions);
            $menus = array_map(function ($item) {
                return $item->toArray();
            }, $menu);

            $this['menus'] = $menus;
        } else {
            $menu = $this->entityManager->find(get_class($this->menu), $id);
            $this['menu'] = $menu->toArray();
        }


        return $this;
    }

    /**
     * menu create.
     *
     * @param int $shop_id
     * @param string $name
     * @param string $type
     * @return ResourceObject
     */
    public function onPost(int $shop_id, string $name, string $type): ResourceObject
    {
        $this->menu->setShopId($shop_id);
        $this->menu->setName($name);
        $this->menu->setType($type);

        $this->entityManager->persist($this->menu);
        $this->entityManager->flush();

        $this->headers['Location'] = '/menu?id=' . $this->menu->getId();
        $this->code = 201;

        return $this;
    }

    /**
     * menu update.
     *
     * @param int $id
     * @param int $shop_id
     * @param string $name
     * @param string $type
     * @return ResourceObject
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @internal param string $address
     */
    public function onPut(int $id, int $shop_id, string $name, string $type): ResourceObject
    {
        $this->menu = $this->entityManager->find(get_class($this->menu), $id);
        $this->menu->setShopId($shop_id);
        $this->menu->setName($name);
        $this->menu->setType($type);

        $this->entityManager->persist($this->menu);
        $this->entityManager->flush();

        $this->headers['Location'] = '/menu?id=' . $this->menu->getId();

        return $this;
    }

    /**
     * delete menu.
     *
     * @param int $id
     * @return ResourceObject
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function onDelete(int $id): ResourceObject
    {
        $this->menu = $this->entityManager->find(get_class($this->menu), $id);

        $this->entityManager->remove($this->menu);
        $this->entityManager->flush();

        return $this;
    }
}