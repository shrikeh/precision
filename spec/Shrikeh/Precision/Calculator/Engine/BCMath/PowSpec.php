<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\BCMath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PowSpec extends ObjectBehavior
{
    function it_can_raise_to_the_power()
    {
        $this->pow(4.315842, 2, 3)->shouldReturn('18.626');
    }

    function it_is_invokable()
    {
        $this(11.33333, 5, 5)->shouldReturn('186976.77853');
    }
}
