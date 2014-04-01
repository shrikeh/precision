<?php

namespace spec\Shrikeh\Precision;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Number;

class NumberSpec extends ObjectBehavior
{
    function it_gives_me_back_the_number_i_gave_it()
    {
        $this->beConstructedWith(121.9201347);
        $this->getValue()->shouldReturn('121.92');
    }

    function it_gives_me_back_a_clean_value()
    {
        $this->beConstructedWith(121.000000);
        $this->getValue()->shouldReturn('121.00');
    }

    function it_throws_an_exception_if_i_give_it_an_invalid_scale()
    {
        $this->shouldThrow('InvalidArgumentException')->during__construct(121.9201347, 'x');
    }

    function it_lets_me_subtract_from_it()
    {
        $this->beConstructedWith(121.9201347);
        $precision = new Number(46.981, 3);
        $this->sub($precision)->shouldMatchPrecision('74.94');
    }

    function it_lets_me_add_to_it()
    {
        $this->beConstructedWith(121.9201347);
        $precision = new Number(46.981, 3);
        $this->add($precision)->shouldMatchPrecision('168.90');
    }

    function it_lets_me_divide_it()
    {
        $this->beConstructedWith(121.9201347, 10);
        $precision = new Number(46.981, 3);
        $this->divide($precision, 1)->shouldMatchPrecision('2.6', 1);
    }

    function it_lets_me_multiply_it()
    {
        $this->beConstructedWith(121.9201347, 8);
        $precision = new Number(46.981, 3);
        $this->multiply($precision, 5)->shouldMatchPrecision('5727.92985', 5);
    }

    function it_rounds_up_numbers_to_the_scale_i_give_it()
    {
        $this->beConstructedWith(121.9201347);
        $precision = new Number(2);
        $this->multiply($precision, 2)->shouldMatchPrecision('243.84');
    }

    public function getMatchers()
    {
        return [
            'matchPrecision' => function(Number $precision, $expected, $scale = null) {
                $expected = new Number($expected, $scale);
                $value1 = $precision->getValue();
                $value2 = $expected->getValue();
                $result = ($value1 === $value2);
                if (!$result) {
                    throw new \Exception("Value $value1 ! = $value2");
                }
                return true;
             }
        ];
    }

}
