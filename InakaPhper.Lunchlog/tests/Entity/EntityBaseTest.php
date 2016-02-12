<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/02/12
 * Time: 23:32
 */

namespace InakaPhper\Lunchlog\Entity;


use ReflectionMethod;

class EntityBaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Anonymous Class extends EntityBase
     */
    private $entity;

    protected function setUp()
    {
        parent::setUp();

        // dummy class extends EntityBase
        $this->entity = new class extends EntityBase
        {
            private $id = 1;
            private $name = 'inaka';
            private $dummy = 'phper';
            private $invisible = 'not display';
            protected $hidden = ['invisible'];

            public function getId(): int
            {
                return $this->id;
            }

            public function getName(): string
            {
                return $this->name;
            }

            public function getDummy(): string
            {
                return $this->dummy;
            }
        };
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\EntityBase::toArray
     */
    public function testToArray()
    {
        $expected = [
            'id' => 1,
            'name' => 'inaka',
            'dummy' => 'phper'
        ];
        $this->assertEquals($expected, $this->entity->toArray());
    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\EntityBase::getObjectVars
     */
    public function testGetObjectVars()
    {
        $method = new  ReflectionMethod($this->entity, 'getObjectVars');
        $method->setAccessible(true);

        $expected = [
            'id',
            'name',
            'dummy'
        ];
        $this->assertEquals($expected, $method->invokeArgs($this->entity, []));

    }

    /**
     * @corvers InakaPhper\Lunchlog\Entity\EntityBase::isHidden
     */
    public function testIsHidden()
    {
        $method = new  ReflectionMethod($this->entity, 'isHidden');
        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($this->entity, ['id']));
        $this->assertTrue($method->invokeArgs($this->entity, ['invisible']));
    }
}
