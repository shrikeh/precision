<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\BCMath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SubtractSpec extends ObjectBehavior
{
    function it_subtracts_one_number_to_another()
    {
        $this->subtract(4.998549, 3, 3)->shouldReturn('1.998');
    }

    function it_uses_scale()
    {
        $this->subtract(4.998549, 3.0005, 12)->shouldReturn('1.998049000000');
    }
}
