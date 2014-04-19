<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\FunctorFactory;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\FunctorFactory;

class EngineFunctorFactory implements FunctorFactory
{
    private $functors = array();

    public function __construct(array $functors = array())
    {
        $this->functors = $functors;
    }

    public function offsetGet($functorId)
    {
        if (!$this->offsetExists($functorId)) {
            throw new FunctorFactoryException("Unable to find a functor matching $functorId");
        }
        $functor = $this->functors[$functorId];
        if (is_string($functor)) {
            $functor = new $functor();
            $this->functors[$functorId] = $functor;
        }
        return $functor;
    }

    public function offsetSet($functorId, $functor)
    {
        $functors = $this->functors;
        $functors[$functorId] = $functor;
        return new self($functors);
    }

    public function offsetUnset($functorId)
    {
        $functors = $this->functors;
        unset($functors[$functorId]);
        return new self($functors);
    }

    public function offsetExists($functorId)
    {
        return array_key_exists($functorId, $this->functors);
    }
}
