<?php

namespace spec\Shrikeh\Precision\Calculator\Engine;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine;
use \Shrikeh\Precision\NumberFactory;

class FloatSpec extends ObjectBehavior
{
    function it_is_initializable(
        NumberFactory $factory,
        FunctorEngine $engine
    ) {
        $this->beConstructedWith($factory, $engine);
        $this->shouldHaveType('Shrikeh\Precision\Calculator\Engine\Float');
    }
}
