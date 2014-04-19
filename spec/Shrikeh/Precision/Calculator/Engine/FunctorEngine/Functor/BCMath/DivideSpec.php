<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\BCMath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DivideSpec extends ObjectBehavior
{
    function it_can_divide_floats()
    {
        $this->divide(18.175439201, 4.98372504, 7)->shouldReturn('3.6469586');
    }
}
