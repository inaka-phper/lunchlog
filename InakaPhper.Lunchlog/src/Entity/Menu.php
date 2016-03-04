<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/03/04
 * Time: 21:41
 */

namespace InakaPhper\Lunchlog\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * Class Menu
 * @package InakaPhper\Lunchlog\Entity
 *
 * @Entity
 * @Table(name="menu")
 */
class Menu extends EntityBase
{
    /**
     * @var integer
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @var integer
     * @Column(type="integer")
     */
    private $shop_id;

    /**
     * @var string
     * @Column(type="text")
     */
    private $name;

    /**
     * @var string
     * @Column(type="text")
     */
    private $type;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getShopId(): int
    {
        return $this->shop_id;
    }

    /**
     * @param int $shop_id
     */
    public function setShopId(int $shop_id)
    {
        $this->shop_id = $shop_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}