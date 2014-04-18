<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Number;

class NumberClassCache implements \ArrayAccess
{
    private $classMap;

    public function offsetGet($value)
    {
        return $this->getNumberClassByValue($value);
    }

    public function offsetSet($values, $number)
    {
        return $this->setNumberClass($number, (array) $values);
    }

    public function offsetUnset($value)
    {
        if ($class = $this->getNumberClassByValue($value)) {
            $this->classMap->offsetUnset($class);
        }
    }

    public function offsetExists($value)
    {
        return ($this->getNumberClassByValue($value));
    }

    private function getNumberClassByValue($value)
    {
        $search = (binary) $value;
        $storage = $this->getInstanceStorage();
        foreach ($storage as $class => $values) {
            if (in_array($search, $values)) {
                return $class;
            }
        }
    }

    private function setNumberClass($class, $values = array())
    {
        $keys = array();
        foreach ($values as $value) {
            $keys[] = (binary) $value;
        }
        $this->getInstanceStorage()->offsetSet($class, $keys);
    }

    private function getInstanceStorage()
    {
        if (!$this->classMap) {
            $this->classMap = new \ArrayObject();
        }
        return $this->classMap;
    }
}
