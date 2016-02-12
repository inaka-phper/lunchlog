<?php
/**
 * Created by PhpStorm.
 * User: phper
 * Date: 16/02/11
 * Time: 22:42
 */

namespace InakaPhper\Lunchlog\Entity;


use Doctrine\Common\Util\Inflector;
use ReflectionClass;

/**
 * Class EntityBase
 * @package InakaPhper\Lunchlog\Entity
 */
abstract class EntityBase
{
    /**
     * Property to hide at the time of toArray().
     *
     * @var array
     */
    protected $hidden = [];

    abstract public function getId(): int;

    /**
     * convert to array from object.
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = [];

        foreach ($this->getObjectVars() as $property) {
            $method = Inflector::camelize('get_' . $property);
            if (method_exists($this, $method)) {
                $result[$property] = $this->$method();
            }
        }

        return $result;
    }

    /**
     * called class's properties.
     *
     * @return array
     */
    private function getObjectVars(): array
    {
        $properties = [];
        $reflection = new ReflectionClass(get_called_class());
        foreach ($reflection->getProperties() as $item) {
            if ($this->isHidden($item->getName())) {
                // hidden property is skip.
                continue;
            }

            array_push($properties, $item->getName());
        }

        return $properties;
    }

    /**
     * hidden property.
     *
     * @param string $name
     * @return bool
     */
    private function isHidden(string $name): bool
    {
        array_push($this->hidden, 'hidden');

        return in_array($name, $this->hidden, true);
    }
}