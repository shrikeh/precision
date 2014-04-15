<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Calculator as CalculatorInterface;
use \Shrikeh\Precision\Calculator\CalculatorEngine as Engine;
use Shrikeh\Precision\Number\FloatingPoint;
use Shrikeh\Precision\Number;

class Calculator implements CalculatorInterface
{
    private $engine;

    private $defaultScale;

    public function __construct(Engine $engine, $defaultScale = 2)
    {
        $this->engine = $engine;
        $this->defaultScale = $defaultScale;
    }

    public function getDefaultScale()
    {
        return $this->defaultScale;
    }

    public function create($number, $scale = null)
    {
        return new FloatingPoint(
            $this,
            $number,
            $this->scale($scale)
        );
    }

    public function getEngine()
    {
        return $this->engine;
    }

    public function compare(Number $number, Number $muliplier, $scale = null)
    {
        $result = $this->getEngine()->compare(
            $number->getValue(),
            $muliplier->getValue(),
            $this->scale($scale)
        );
        return $result;
    }

    public function add(Number $number, Number $muliplier, $scale = null)
    {
        $scale = $this->scale($scale);
        $result = $this->getEngine()->add(
            $number->getValue(),
            $muliplier->getValue(),
            $scale
        );
        return new FloatingPoint($this, $result, $scale);
    }

    public function subtract(Number $number, Number $muliplier, $scale = null)
    {
        $scale = $this->scale($scale);
        $result = $this->getEngine()->subtract(
            $number->getValue(),
            $muliplier->getValue(),
            $scale
        );
        return new FloatingPoint($this, $result, $scale);
    }

    public function multiply(Number $number, Number $muliplier, $scale = null)
    {
        $scale = $this->scale($scale);
        $result = $this->getEngine()->multiply(
            $number->getValue(),
            $muliplier->getValue(),
            $scale
        );
        return new FloatingPoint($this, $result, $scale);
    }

    public function divide(
        Number $number,
        Number $muliplier,
        $scale = null
    ) {
        $scale = $this->scale($scale);
        $result = $this->getEngine()->divide(
            $number->getValue(),
            $muliplier->getValue(),
            $scale
        );
        return new FloatingPoint($this, $result, $scale);
    }

    public function round(Number $number, $scale)
    {
        $result = $this->getEngine()->round(
            $number->getValue(),
            $this->scale($scale)
        );
        return new FloatingPoint($this, $result, $scale);
    }

    private function scale($scale = null)
    {
        if (null === $scale) {
            $scale = $this->getDefaultScale();
        }
        return (int) $scale;
    }
}
