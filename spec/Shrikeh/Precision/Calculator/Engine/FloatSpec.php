<?php

namespace spec\Shrikeh\Precision\Calculator\Engine;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;

class FloatSpec extends ObjectBehavior
{
    function it_returns_the_right_number_when_i_divide_a_number()
    {
        $this->divide(15.9, 5.3)->shouldReturn('3');
    }

    function it_can_multiply_floats()
    {
        $this->multiply(4.315842, 2.2, 3)->shouldReturn('9.494');
    }

    function it_can_divide_floats()
    {
        $this->divide(18.175439201, 4.98372504, 7)->shouldReturn('3.6469586');
    }

    function it_can_add()
    {
        $this->add(4.998549, 3, 3)->shouldReturn('7.998');
    }

    function it_can_subtract()
    {
        $this->subtract(9.11111111789, 3.46465645, 9)->shouldReturn('5.646454667');
    }

    function it_can_multiply_floats_to_a_power()
    {
        $this->pow(12.7438789, 9, 7)->shouldReturn('8865734531.0674715');
    }

    function it_returns_a_valid_modulus()
    {
        $this->mod(12.7579, 1.34577)->shouldReturn('0.64597');
    }
}
