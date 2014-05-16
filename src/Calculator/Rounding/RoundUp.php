<?php
namespace Shrikeh\Precision\Calculator\Rounding;

use \Shrikeh\Precision\Calculator\Rounder;

class RoundUp implements Rounder
{
    private $scale;

    public function __construct($scale)
    {
        $this->scale = $scale;
    }

    public function round($value)
    {
        $fix = '5';
        for ($i = 0; $i < $this->scale; $i++) {
            $fix = "0$fix";
        }
        $value = bcadd($value, "0.$fix", $this->scale + 1);
        return bcdiv($value, '1.0', $this->scale);
    }

    public function getScale()
    {
        return $this->scale;
    }
}
