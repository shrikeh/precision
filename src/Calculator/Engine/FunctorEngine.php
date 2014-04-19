<?php
namespace Shrikeh\Precision\Calculator\Engine;

interface FunctorEngine
{
    const COMPARE   = 'compare';

    const ADD       = 'add';

    const SUBTRACT  = 'subtract';

    const DIVIDE    = 'divide';

    const MULTIPLY  = 'multiply';

    const ROUND     = 'round';

    const MOD       = 'mod';

    const POW       = 'pow';

    public function compare($leftOperand, $rightOperand, $precision);

    public function divide($leftOperand, $rightOperand, $precision);

    public function multiply($leftOperand, $rightOperand, $precision);

    public function add($leftOperand, $rightOperand, $precision);

    public function subtract($leftOperand, $rightOperand, $precision);

    public function pow($leftOperand, $rightOperand, $precision);
}
