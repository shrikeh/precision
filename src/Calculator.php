<?php
namespace Shrikeh\Precision;

interface Calculator
{
    const DEFAULT_SCALE = 2;

    public function create($number);

    public function compare(Number $number, Number $muliplier, $scale = null);

    public function add(Number $number, Number $muliplier, $scale = null);

    public function subtract(Number $number, Number $muliplier, $scale = null);

    public function multiply(Number $number, Number $muliplier, $scale = null);

    public function divide(Number $number, Number $muliplier, $scale = null);
}
