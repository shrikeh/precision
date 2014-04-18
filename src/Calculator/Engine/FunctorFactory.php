<?php
namespace Shrikeh\Precision\Calculator\Engine;

interface FunctorFactory extends \ArrayAccess
{
    const COMPARE   = 'compare';

    const ADD       = 'add';

    const SUBTRACT  = 'subtract';

    const DIVIDE    = 'divide';

    const MULTIPLY  = 'multiply';

    const ROUND     = 'round';

    const MOD       = 'mod';

    const POW       = 'pow';

}
