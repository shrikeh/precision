<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\Infinite;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Number;

class CompareSpec extends ObjectBehavior
{
    function it_is_invokable()
    {
        $finite = PHP_INT_MAX;
        $infinite = INF;

        $this($infinite, $finite, 0)->shouldReturn(1);
    }

    function it_returns_one_when_it_is_larger()
    {
        $finite = PHP_INT_MAX;
        $infinite = INF;

        $this->compare($infinite, $finite, 0)->shouldReturn(1);
    }

    function it_returns_zero_when_it_is_equal()
    {
        $this->compare(INF, INF, 0)->shouldReturn(0);
    }

    function it_returns_minus_one_when_it_is_smaller()
    {
        $infinite = -INF;
        $finite = -PHP_INT_MAX;
        $this->compare($infinite, $finite, 0)->shouldReturn(-1);
    }

    function it_returns_minus_one_when_negative_infinity_compared_to_positive_infinity()
    {
        $positiveInfinite = INF;
        $negativeInfinite = -INF;
        $this->compare($negativeInfinite, $positiveInfinite, 0)->shouldReturn(-1);
    }

    function it_returns_one_when_positive_infinity_compared_to_negative_infinity()
    {
        $positiveInfinite = INF;
        $negativeInfinite = -INF;
        $this->compare($positiveInfinite, $negativeInfinite, 0)->shouldReturn(1);
    }

    function it_returns_minus_one_when_negative_infinity_is_compared_to_zero()
    {
        $infinite = -INF;
        $finite = 0;
        $this->compare($infinite, $finite, 0)->shouldReturn(-1);
    }
}
