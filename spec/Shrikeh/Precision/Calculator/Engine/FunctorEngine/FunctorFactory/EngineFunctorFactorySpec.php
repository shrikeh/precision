<?php

namespace spec\Shrikeh\Precision\Calculator\Engine\FunctorFactory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Shrikeh\Precision\Calculator\Engine\FunctorFactory;

class EngineFunctorFactorySpec extends ObjectBehavior
{
    function it_returns_a_functor()
    {
        $this->beConstructedWith(array(
            FunctorFactory::MULTIPLY => '\stdClass'
        ));
        $this[FunctorFactory::MULTIPLY]->shouldBeLike(new \stdClass());
    }

    function it_returns_a_previously_created_object()
    {
        $functor = new \ArrayObject(array());

        $this->beConstructedWith(array(
            FunctorFactory::MULTIPLY => $functor,
        ));
        $this[FunctorFactory::MULTIPLY]->shouldReturn($functor);
    }

    function it_supports_singleton_factory()
    {
        $this->beConstructedWith(array(
            FunctorFactory::MULTIPLY => '\stdClass'
        ));
        $stdClass = $this[FunctorFactory::MULTIPLY];
        $this[FunctorFactory::MULTIPLY]->shouldReturn($stdClass);
    }
}
