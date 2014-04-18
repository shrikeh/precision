<?php
namespace Shrikeh\Precision;

use \Shrikeh\Precision\Calculator;
use \Shrikeh\Precision\Calculator\NumberClassCache;

class NumberFactory
{
    use \Shrikeh\Precision\Traits\EmbeddedCalculator;

    private $numberClasses = array();

    private $classMapCache;

    private $numberCache;

    public function __construct(
        Calculator $calculator,
        $classes,
        NumberClassCache $classMapCache = null,
        $numberCache = array()
    )
    {
        $this->calculator       = $calculator;
        $this->numberClasses    = $classes;
        $this->classMapCache    = $classMapCache;
        $this->numberCache      = $numberCache;
    }

    public function __invoke($value)
    {
        return $this->create($value);
    }

    public function create($value)
    {
        if (!$number = $this->getCachedNumber($value)) {
            $class = $this->getClassFor($value);
            $number = new $class(
                $this->getCalculator(),
                $value
            );
            if ($this->isDeterministic($class)) {
                $this->setCachedNumber($value, $number);
            }
        }
        return $number;
    }

    public function getClassFor($value)
    {
        if (!$class = $this->getClassByValue($value)) {
            foreach ($this->numberClasses as $class) {
                $this->setClassMap($class);
                if ($class::match($value)) {
                    return $class;
                }
            }
        }
    }

    private function getClassByValue($value)
    {
        if ($this->classMapCache) {
            $value = (binary) $value;
            if (isset($this->classMapCache[$value])) {
                return $this->classMapCache[$value];
            }
        }
    }

    private function setClassMap($class)
    {
        if ($this->classMapCache) {
            if ($this->isDeterministic($class)) {
                $values = $class::getDeterministicValues();
                $this->classMapCache[$values] = $class;
            }
        }
    }

    private function isDeterministic($class)
    {
        $implements = class_implements($class);
        return (isset($implements['Shrikeh\Precision\Number\DeterministicNumber']));
    }

    private function setCachedNumber($value, Number $number)
    {
        $value = (string) $value;
        $this->numberCache[$value] = $number;
    }

    private function getCachedNumber($value)
    {
        $value = (binary) $value;
        if (isset($this->numberCache[$value])) {
            return $this->numberCache[$value];
        }
    }
}
