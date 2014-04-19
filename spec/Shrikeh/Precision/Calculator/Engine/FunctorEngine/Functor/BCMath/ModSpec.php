<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\BCMath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModSpec extends ObjectBehavior
{
    function it_returns_the_correct_modulus()
    {
        $this->mod(11.33333, 4)->shouldReturn('3.33333');
    }

    function it_is_invokable()
    {
        $this(11.33333, 4)->shouldReturn('3.33333');
    }
}
