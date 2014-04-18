<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\Infinite;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;

class AddSpec extends ObjectBehavior
{
    function it_is_invokable()
    {
        $this(INF, PHP_INT_MAX, 0)->shouldReturn(INF);
    }

    function it_returns_infinity_when_you_add_infinity_to_infinity()
    {
        $this->add(INF, INF)->shouldReturn(INF);
    }

    function it_returns_infinity_when_you_add_infinity_to_any_positive_integer()
    {
        $this->add(INF, 1)->shouldReturn(INF);
    }

    function it_returns_nan_when_you_add_negative_infinity_to_infinity()
    {
        $this->add(INF, -INF)->shouldBeNaN();
    }

    function it_returns_infinity_when_you_add_a_negative_integer_to_infinity()
    {
        $this->add(INF, -3)->shouldReturn(INF);
    }

    public function it_returns_its_name()
    {
        $this->getName()->shouldReturn('Add');
    }

    public function getMatchers()
    {
        return [
          'beNaN' => function($result) {
                  return is_nan($result);
              }
        ];
    }
}
