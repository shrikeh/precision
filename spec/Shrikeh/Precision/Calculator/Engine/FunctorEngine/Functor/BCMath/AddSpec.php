<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\BCMath;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddSpec extends ObjectBehavior
{
    function it_adds_one_number_to_another()
    {
        $this->add(4.998549, 3, 3)->shouldReturn('7.998');
    }

    function it_uses_scale()
    {
        $this->add(4.998549, 3.0005, 12)->shouldReturn('7.999049000000');
    }

    function it_is_invokable()
    {
        $this(9.12738467384, 3.783463846, 4)->shouldReturn('12.9108');
    }

    function it_can_handle_strings_as_arguments()
    {
        $this->add('1234.65483874837', '32423423445', '12')->shouldReturn('32423424679.654838748370');
    }

    function it_can_add_big_numbers()
    {
        $number = (string) PHP_INT_MAX;
        $fraction = '.90123';
        $this->add($number, '0' . $fraction, 5)->shouldReturn($number . $fraction);
    }
}
