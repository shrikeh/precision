<?php

namespace spec\Shrikeh\Precision;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Number\Zero;

class NumberFactorySpec extends ObjectBehavior
{
    public function let($calculator, $classCache)
    {
        $calculator->beADoubleOf('\Shrikeh\Precision\Calculator');

        $classes = array(
            '\Shrikeh\Precision\Number\Zero',
            '\Shrikeh\Precision\Number\Infinity',
            '\Shrikeh\Precision\Number\NotANumber',
            '\Shrikeh\Precision\Number\FloatingPoint',
        );
        $classCache->beADoubleOf('\Shrikeh\Precision\Calculator\NumberClassCache');
        $this->beConstructedWith($calculator, $classes, $classCache);
    }

    function it_accepts_a_list_of_classes_to_use()
    {
        $this->getClassFor(INF)->shouldReturn('\Shrikeh\Precision\Number\Infinity');
    }

    function it_returns_a_floating_point_number()
    {
        $number = 0.01;
        $this->create($number)->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\FloatingPoint');
    }

    function it_returns_an_infinite_number()
    {
        $number = INF;
        $this->create($number)->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\Infinity');
    }

    function it_returns_an_infinity_number_when_infinity_is_negative()
    {
        $number = -INF;
        $this->create($number)->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\Infinity');
    }

    function it_returns_a_zero_number_when_a_number_equals_zero()
    {
        $number = 0.0000000000;
        $this->create($number)->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\Zero');
    }

    function it_returns_a_not_a_number_when_a_number_equals_NAN()
    {
        $number = NAN;
        $this->create($number)->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\NotANumber');
    }

    function it_is_invokable()
    {
        $number = 0.0000000000;
        $this($number)->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\Zero');
    }

    function it_uses_cacheable_numbers()
    {
        $zero = $this->create(0);
        $this->create(0)->shouldReturn($zero);
    }
}
