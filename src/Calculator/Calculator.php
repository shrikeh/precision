<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Calculator as CalculatorInterface;
use \Shrikeh\Precision\Calculator\CalculatorEngine as Engine;
use Shrikeh\Precision\Number\FloatingPoint;
use Shrikeh\Precision\Number;

class Calculator implements CalculatorInterface
{
    private $engines = array();

    private $defaultScale;

    private $numberFactory;

    private $zero;

    public function __construct(\Closure $numberFactory, $engines = array(), $defaultScale = 2)
    {

        $numberFactory = $numberFactory->bindTo($this, $this);
        $this->numberFactory = $numberFactory();

        $this->defaultScale = $defaultScale;

        foreach ($engines as $engine) {
            $this->addEngine($engine);
        }
    }

    public function __invoke($value)
    {
        return $this->create($value);
    }

    public function getDefaultScale()
    {
        return $this->defaultScale;
    }

    public function create($value)
    {
        return $this->getNumberFactory()->create($value);
    }

    public function compare(Number $number, Number $comparer, $scale = null)
    {
        return $this->getEngine($number, $comparer)->compare(
            $number,
            $comparer,
            $this->scale($scale)
        );
    }

    public function add(Number $number, Number $add, $scale = null)
    {
        return $this->getEngine($number, $add)->add(
            $number,
            $add,
            $this->scale($scale)
        );
    }

    public function subtract(Number $number, Number $subtractor, $scale = null)
    {
        $result = $this->getEngine($number, $subtractor)->subtract(
            $number,
            $subtractor,
            $this->scale($scale)
        );
        return $this->getNumberFactory()->create($result);
    }

    public function multiply(Number $number, Number $muliplier, $scale = null)
    {
        $result = $this->getEngine($number, $muliplier)->multiply(
            $number,
            $muliplier,
            $this->scale($scale)
        );
        return $this->getNumberFactory()->create($result);
    }

    public function divide(Number $number, Number $divisor, $scale = null) {
        $result = $this->getEngine($number, $divisor)->divide(
            $number,
            $divisor,
            $this->scale($scale)
        );
        return $this->getNumberFactory()->create($result);
    }

    public function round(Number $number, $scale)
    {
        $result = $this->getEngine($number)->round(
            $number->getValue(),
            $this->scale($scale)
        );
        return $this->getNumberFactory()->create($result);
    }

    public function zero()
    {
        if (!isset($this->zero)) {
            $this->zero = $this->getNumberFactory()->create(0);
        }
        return $this->zero;
    }

    public function getNumberFactory()
    {
        return $this->numberFactory;
    }

    public function getEngines()
    {
        return $this->engines;
    }

    private function getEngine()
    {
        foreach ($this->getEngines() as $engine) {
            if ($engine->validate(func_get_args())) {
                return $engine;
            }
        }
    }

    private function addEngine(Engine $engine)
    {
        $this->engines[] = $engine;
    }

    private function scale($scale = null)
    {
        if (null === $scale) {
            $scale = $this->getDefaultScale();
        }
        return (int) $scale;
    }
}
