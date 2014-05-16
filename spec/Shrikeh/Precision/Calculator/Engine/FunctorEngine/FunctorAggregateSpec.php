<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\FunctorEngine;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\FunctorFactory;

class FunctorAggregateSpec extends ObjectBehavior
{
    public function let($functorFactory)
    {
        $factoryClass = '\Shrikeh\Precision\Calculator\Engine\FunctorEngine\FunctorFactory\EngineFunctorFactory';
        $functorFactory->beADoubleOf($factoryClass);
        $this->beConstructedWith($functorFactory);
    }

    function it_returns_the_right_number_when_i_divide_a_number($functorFactory)
    {
        $functorFactory->offsetGet(FunctorEngine::DIVIDE)->willReturn(function() { return '3'; });
        $this->divide(15.9, 5.3)->shouldReturn('3');
    }

    function it_can_multiply_floats($functorFactory)
    {
        $functorFactory->offsetGet(FunctorEngine::MULTIPLY)->willReturn(function() { return '9.494'; });
        $this->multiply(4.315842, 2.2, 3)->shouldReturn('9.494');
    }

    function it_can_divide_floats($functorFactory)
    {
        $functorFactory->offsetGet(FunctorEngine::DIVIDE)->willReturn(function() { return '3.6469586'; });
        $this->divide(18.175439201, 4.98372504, 7)->shouldReturn('3.6469586');
    }

    function it_can_add($functorFactory)
    {
        $functorFactory->offsetGet(FunctorEngine::ADD)->willReturn(function() { return '7.998'; });
        $this->add(4.998549, 3, 3)->shouldReturn('7.998');
    }

    function it_can_subtract($functorFactory)
    {
        $functorFactory->offsetGet(FunctorEngine::SUBTRACT)->willReturn(function() { return '5.646454667'; });
        $this->subtract(9.11111111789, 3.46465645, 9)->shouldReturn('5.646454667');
    }

    function it_can_multiply_floats_to_a_power($functorFactory)
    {
        $functorFactory->offsetGet(FunctorEngine::POW)->willReturn(function() { return '8865734531.0674715'; });
        $this->pow(12.7438789, 9, 7)->shouldReturn('8865734531.0674715');
    }

    function it_returns_a_valid_modulus($functorFactory)
    {
        $functorFactory->offsetGet(FunctorEngine::MOD)->willReturn(function() { return '0.64597'; });
        $this->mod(12.7579, 1.34577)->shouldReturn('0.64597');
    }
}
