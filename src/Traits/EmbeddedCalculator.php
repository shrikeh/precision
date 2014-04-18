<?php
/** @noinspection PhpUndefinedConstantInspection */
namespace Shrikeh\Precision\Traits;

use \Shrikeh\Precision\Number;

trait EmbeddedCalculator
{
    private $calculator;

    public function getCalculator()
    {
        return $this->calculator;
    }
}
