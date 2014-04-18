<?php
namespace Shrikeh\Precision\Calculator\Engine\Functor;

trait NamedTrait
{
    public function getName()
    {
        $classname = __CLASS__;
        if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
            $classname = $matches[1];
        }
        return $classname;
    }
}
