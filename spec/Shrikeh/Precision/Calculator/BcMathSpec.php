<?php

namespace spec\Shrikeh\Precision\Calculator;

    use \PhpSpec\ObjectBehavior;
    use \Prophecy\Argument;
    use \Shrikeh\Precision\Number;
    use \Shrikeh\Precision\Number\FloatingPoint;

class BCMathSpec extends ObjectBehavior
{

    function it_should_give_me_a_new_number()
    {
        $number = 12344.6;
        $precision = new FloatingPoint($number, $this->getWrappedObject());
        $this->create($number)->shouldBeLike($precision);
    }

    function it_gives_me_a_number_with_the_correct_scale()
    {
        $number = 12344.6;
        $precision = new FloatingPoint($number, $this->getWrappedObject());
        $this->create($number)->shouldBeLike($precision);
    }

    function it_gives_me_a_number_when_invoked()
    {
        $number = 12344.6;
        $precision = new FloatingPoint($number, $this->getWrappedObject());
        $this($number)->shouldBeLike($precision);
    }


    function it_returns_the_right_number_when_i_divide_a_number(
        Number $number,
        Number $divisor
    )
    {
        $number->getValue()->willReturn(5);
        $divisor->getValue()->willReturn(3);
        $precision = new FloatingPoint(1.67, $this->getWrappedObject());
        $this->divide($number, $divisor)->shouldBeLike($precision);
    }

    /*
    function it_can_multiply_floats()
    {
        $this->multiply(4.315842, 2.2, 3)->shouldReturn('9.495');
    }

    function it_can_divide_floats()
    {
        $this->divide(18.175439201, 4.98372504, 7)->shouldReturn('3.6469587');
    }

    function it_can_add()
    {
        $this->add(4.998549, 3, 3)->shouldReturn('7.999');
    }

    function it_can_subtract()
    {
        $this->subtract(9.11111111789, 3.46465645, 9)->shouldReturn('5.646454668');
    }
    */
}
