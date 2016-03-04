<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/03/04
 * Time: 21:40
 */

namespace InakaPhper\Lunchlog\Entity;


class MenuTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Menu
     */
    private $entity;

    protected function setUp()
    {
        parent::setUp();

        $this->entity = new Menu();
        $this->entity->setId(10);
        $this->entity->setShopId(11);
        $this->entity->setName('phper');
        $this->entity->setType('2016-01-01 12:00:00');
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\Menu::setId
     * @corvers InakaPhper\Lunchlog\Entity\Menu::getId
     */
    public function testSetIdAndGetId()
    {
        $this->entity->setId(20);

        $this->assertEquals(20, $this->entity->getId());
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\Menu::setShopId
     * @corvers InakaPhper\Lunchlog\Entity\Menu::getShopId
     */
    public function testSetShopIdAndGetShopId()
    {
        $this->entity->setShopId(21);

        $this->assertEquals(21, $this->entity->getShopId());
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\Menu::setName
     * @corvers InakaPhper\Lunchlog\Entity\Menu::getName
     */
    public function testSetNameAndGetName()
    {
        $this->entity->setName('inaka');

        $this->assertEquals('inaka', $this->entity->getName());
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\Menu::setType
     * @corvers InakaPhper\Lunchlog\Entity\Menu::getType
     */
    public function testSetTypeAndGetType()
    {
        $this->entity->setType('cafe');

        $this->assertEquals('cafe', $this->entity->getType());
    }
}
