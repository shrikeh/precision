<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\BCMath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MultiplySpec extends ObjectBehavior
{
    function it_can_multiply_floats()
    {
        $this->multiply(4.315842, 2.2, 3)->shouldReturn('9.494');
    }

    function it_is_invokable()
    {
        $this(11.33333, 4.97534, 5)->shouldReturn('56.38717');
    }
}
