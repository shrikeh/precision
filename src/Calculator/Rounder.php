<?php

namespace Shrikeh\Precision\Calculator;

interface Rounder
{
    const ROUND_NONE                    = 0;

    const ROUND_UP                      = 1;

    const ROUND_DOWN                    = 2;

    const ROUND_TOWARDS_ZERO            = 4;

    const ROUND_AWAY_ZERO               = 8;

    const ROUND_TO_NEAREST              = 16;

    const TIE_ROUND_HALF_UP             = 0;

    const TIE_ROUND_HALF_DOWN           = 1;

    const TIE_ROUND_HALF_AWAY_ZERO      = 2;

    const TIE_ROUND_HALF_TOWARDS_ZERO   = 4;

    const TIE_ROUND_HALF_TO_EVEN        = 8;

    const TIE_ROUND_HALF_TO_ODD         = 16;

    const TIE_ROUND_STOCHASTIC          = 32;


}
