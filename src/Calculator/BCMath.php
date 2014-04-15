<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Calculator;
use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Number\FloatingPoint;

class BCMath implements Calculator
{
    private $defaultScale;

    public function __construct($defaultScale = Calculator::DEFAULT_SCALE)
    {
        $this->defaultScale = $defaultScale;
    }

    public function __invoke($number, $scale = null)
    {
        return $this->create($number, $scale);
    }

    public function getDefaultScale()
    {
        return $this->defaultScale;
    }

    public function create($number)
    {
        return new FloatingPoint($number, $this);
    }

    public function add(Number $leftOperand, Number $rightOperand, $scale = null)
    {
        return $this->performCallback('bcadd', $leftOperand, $rightOperand, $scale);
    }

    public function subtract(Number $leftOperand, Number $rightOperand, $scale = null)
    {
        return $this->performCallback('bcsub', $leftOperand, $rightOperand, $scale);
    }

    public function multiply(Number $leftOperand, Number $rightOperand, $scale = null)
    {
        return $this->performCallback('bcmul', $leftOperand, $rightOperand, $scale);
    }

    public function divide(Number $leftOperand, Number $rightOperand, $scale = null)
    {
        return $this->performCallback('bcdiv', $leftOperand, $rightOperand, $scale);
    }

    public function pow(Number $leftOperand, Number $rightOperand, $scale = null)
    {
        return $this->performCallback('bcpow', $leftOperand, $rightOperand, $scale);
    }

    public function compare(Number $leftOperand, Number $rightOperand, $scale = null)
    {
        $scale          = $this->scale($scale);
        $leftNumber     = $this->roundToScale($leftOperand->getValue(), $scale);
        $rightNumber    = $this->roundToScale($rightOperand->getValue(), $scale);
        return bccomp($leftNumber, $rightNumber, $scale);
    }

    public function round(Number $number, $scale = 0)
    {
        $roundToScale = $this->roundToScale(
            $number->getValue(),
            $scale
        );
        return $this->create($roundToScale);
    }

    private function roundToScale($precision, $scale)
    {
        $fix = '5';
        for ($i = 0; $i < $scale; $i++) {
            $fix = "0$fix";
        }
        $number = bcadd($precision, "0.$fix", $scale + 1);
        return bcdiv($number, '1.0', $scale);
    }

    private function scale($scale = null)
    {
        if (null === $scale) {
            $scale = $this->getDefaultScale();
        }
        return (int) $scale;
    }

    /**
     * @param                                  $callback
     * @param Number|\Shrikeh\Precision\Number $leftOperand
     * @param Number|\Shrikeh\Precision\Number $rightOperand
     * @param                                  $scale
     *
     * @return FloatingPoint
     */
    private function performCallback($callback, Number $leftOperand, Number $rightOperand, $scale)
    {
        $scale          = $this->scale($scale);
        $leftNumber     = $leftOperand->getValue();
        $rightNumber    = $rightOperand->getValue();

        $result = $this->roundToScale(
            call_user_func($callback, $leftNumber, $rightNumber, $scale + 1),
            $scale
        );
        return $this->create($result);
    }
}
