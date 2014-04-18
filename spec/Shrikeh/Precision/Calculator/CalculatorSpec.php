<?php

namespace spec\Shrikeh\Precision\Calculator;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\NumberFactory;

class CalculatorSpec extends ObjectBehavior
{
    public function let()
    {
        $numberClasses = array(
            '\Shrikeh\Precision\Number\Zero',
            '\Shrikeh\Precision\Number\Infinity',
            '\Shrikeh\Precision\Number\FloatingPoint',
            '\Shrikeh\Precision\Number\NotANumber',
        );
        $numberFactory = function() use ($numberClasses) {
            return new NumberFactory($this, $numberClasses);
        };
        $engines = array();
        $defaultScale = 3;
        $this->beConstructedWith($numberFactory, $engines, $defaultScale);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Shrikeh\Precision\Calculator\Calculator');
    }

    function it_returns_a_floating_point_when_you_give_it_a_floating_point_value()
    {
        $this->create(1.23)->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\FloatingPoint');
    }

    function it_returns_a_number_when_invoked()
    {
        $this(9.127457459475)->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\FloatingPoint');
    }

    function it_returns_zero()
    {
        $this->zero()->shouldReturnAnInstanceOf('\Shrikeh\Precision\Number\Zero');
    }
}
