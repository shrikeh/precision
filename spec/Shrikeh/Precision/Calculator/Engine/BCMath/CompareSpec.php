<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\BCMath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompareSpec extends ObjectBehavior
{
    function it_is_invokable()
    {
        $left = 0.002;
        $right = 1.45678;
        $this($left, $right, 5)->shouldReturn(-1);
    }

    function it_returns_zero_when_comparing_equally()
    {
        $this->compare(121.9201347, 121.9201348, 6)->shouldReturn(0);
    }

    function it_returns_one_when_the_first_operand_is_larger()
    {
        $this->compare(121.9201347, 121.9201346890, 10)->shouldReturn(1);
    }

    function it_returns_minus_one_when_the_first_operand_is_smaller()
    {
        $this->compare(121.920134684999, 121.9201346890, 10)->shouldReturn(-1);
    }

    function it_can_handle_strings_and_simple_integers()
    {
        $this->compare('121.920134684999', 121, 10)->shouldReturn(1);
    }
}
