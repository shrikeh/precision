<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Number;

interface CalculatorEngine
{
    public function validate(array $args);

    public function compare(Number $leftOperand, Number $rightOperand, $precision);

    public function divide(Number $leftOperand, Number $rightOperand, $precision);

    public function multiply(Number $leftOperand, Number $rightOperand, $precision);

    public function add(Number $leftOperand, Number $rightOperand, $precision);

    public function subtract(Number $leftOperand, Number $rightOperand, $precision);

    public function pow(Number $leftOperand, Number $rightOperand, $precision);
}
