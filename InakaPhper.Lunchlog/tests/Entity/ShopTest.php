<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/02/13
 * Time: 21:19
 */

namespace InakaPhper\Lunchlog\Entity;


class ShopTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Shop
     */
    private $entity;

    protected function setUp()
    {
        parent::setUp();

        $this->entity = new Shop();
        $this->entity->setId(10);
        $this->entity->setName('phper');
        $this->entity->setAddress('japan');
        $this->entity->setCreated('2016-01-01 12:00:00');
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\Shop::setId
     * @corvers InakaPhper\Lunchlog\Entity\Shop::getId
     */
    public function testSetIdAndGetId()
    {
        $this->entity->setId(20);

        $this->assertEquals(20, $this->entity->getId());
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\Shop::setName
     * @corvers InakaPhper\Lunchlog\Entity\Shop::getName
     */
    public function testSetNameAndGetName()
    {
        $this->entity->setName('inaka');

        $this->assertEquals('inaka', $this->entity->getName());
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\Shop::setAddress
     * @corvers InakaPhper\Lunchlog\Entity\Shop::getAddress
     */
    public function testSetAddressAndGetAddress()
    {
        $this->entity->setAddress('Meieki, Nakamura, Nagoya, Aitchi, Japan');

        $this->assertEquals('Meieki, Nakamura, Nagoya, Aitchi, Japan', $this->entity->getAddress());
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\Shop::setCreated
     * @corvers InakaPhper\Lunchlog\Entity\Shop::getCreated
     */
    public function testSetCreatedAndGetCreated()
    {
        $this->entity->setCreated('2000-01-01 16:59:59');

        $this->assertEquals('2000-01-01 16:59:59', $this->entity->getCreated());
    }
}
