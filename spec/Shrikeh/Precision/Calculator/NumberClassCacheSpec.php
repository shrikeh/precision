<?php

namespace spec\Shrikeh\Precision\Calculator;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Number;

class NumberClassCacheSpec extends ObjectBehavior
{
    function it_saves_a_number_into_cache()
    {
        $nan = '\Shrikeh\Precision\Number\NotANumber';
        $this->offsetSet(NAN, $nan);
        $this->offsetGet(NAN)->shouldReturn($nan);
    }

    function it_lets_me_remove_a_number_from_cache()
    {
        $float = '\Shrikeh\Precision\Number\FloatingPoint';
        $this->offsetSet(1.11111111111, $float);
        $this[1.11111111111]->shouldReturn($float);
        $this->offsetUnset(1.11111111111);
        $this->offsetGet(1.11111111111)->shouldReturn(null);
    }

    function it_tells_me_if_an_offset_exists()
    {
        $float = '\Shrikeh\Precision\Number\FloatingPoint';
        $this->offsetSet('9.124345335', $float);
        $this->offsetExists('9.124345335')->shouldReturn(true);
    }

    function it_saves_the_numbers_with_keys_that_dont_collide() {
        $infinityClass = $float = '\Shrikeh\Precision\Number\Infinity';
        $this->offsetSet(-INF, $infinityClass);
        $this->offsetSet(INF, $infinityClass);
        $this->offsetGet(INF)->shouldReturn($infinityClass);
        $this->offsetGet(PHP_INT_MAX)->shouldReturn(null);
    }

    function it_allows_array_access_to_numbers()
    {
        $zero = '\Shrikeh\Precision\Number\Zero';
        $this[0] = $zero;
        $this[0]->shouldReturn($zero);
    }
}
