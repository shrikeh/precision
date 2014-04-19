<?php
namespace Shrikeh\Precision\Calculator\Rounder;

use \Shrikeh\Precision\Calculator\Rounder as RounderInterface;

class Rounder implements RounderInterface
{
    private $roundType;

    private $tieBreak;

    public function __construct($roundType, $tieBreak)
    {
        $this->roundType = $roundType;
        $this->tieBreak = $tieBreak;
    }
}
