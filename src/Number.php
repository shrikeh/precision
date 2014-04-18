<?php
namespace Shrikeh\Precision;

interface Number
{
    const GREATER_THAN  = 1;

    const LESS_THAN     = -1;

    const EQUAL_TO      = 0;

    public static function match($value);

    public function getValue();

    public function isInfinite();

    public function isPositive();

    public function isNegative();

    public function isZero();

    public function isFloat();
}
