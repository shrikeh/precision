<?php
namespace Shrikeh\Precision\Calculator;

class Infinite
{
    public function subtract($number, $subtractor)
    {
        if ($subtractor === INF) {
            return ($number === INF) ? 0 : -INF;
        } else {
            return INF;
        }
    }
}
