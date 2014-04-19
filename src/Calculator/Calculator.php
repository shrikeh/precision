<?php
namespace Shrikeh\Precision\Calculator;

use \Closure;
use \Shrikeh\Precision\Calculator as CalculatorInterface;
use Shrikeh\Precision\Number;

/**
 * Class Calculator
 *
 * @package Shrikeh\Precision\Calculator
 */
class Calculator implements CalculatorInterface
{
    /**
     * @var array
     */
    private $engines = array();

    /**
     * @var
     */
    private $defaultScale;

    /**
     * @var
     */
    private $numberFactory;

    /**
     * @var
     */
    private $zero;

    /**
     * @param callable $numberFactory
     * @param array    $engines
     * @param          $defaultScale
     */
    public function __construct(
        Closure $numberFactory,
        $engines = array(),
        $defaultScale
    ) {
        $numberFactory = $numberFactory->bindTo($this, $this);
        $this->numberFactory = $numberFactory();

        $this->setDefaultScale($defaultScale);

        foreach ($engines as $engine) {
            $this->addEngine($engine);
        }
    }

    /**
     * @param mixed $value
     * @return \Shrikeh\Precision\Number
     */
    public function __invoke($value)
    {
        return $this->create($value);
    }

    /**
     * @param integer $scale
     */
    public function setDefaultScale($scale)
    {
        $this->defaultScale = $scale;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultScale()
    {
        return $this->defaultScale;
    }

    /**
     * Create a new new Number.
     *
     * @param mixed $value
     * @return \Shrikeh\Precision\Number
     */
    public function create($value)
    {
        return $this->getNumberFactory()->create($value);
    }


    /**
     * Compare two Numbers.
     *
     * @param           \Shrikeh\Precision\Number $number
     * @param           \Shrikeh\Precision\Number $comparer
     * @param null|int  $scale
     *
     * @return \Shrikeh\Precision\Number
     */
    public function compare(Number $number, Number $comparer, $scale = null)
    {
        return $this->binary('compare', $number, $comparer, $scale);
    }

    /**
     * Add one Number to another.
     *
     * @param           \Shrikeh\Precision\Number $number
     * @param           \Shrikeh\Precision\Number $addend
     * @param null|int  $scale
     *
     * @return \Shrikeh\Precision\Number
     */
    public function add(Number $number, Number $addend, $scale = null)
    {
        return $this->binary('add', $number, $addend, $scale);
    }

    /**
     * Subtract one Number from another.
     *
     * @param           \Shrikeh\Precision\Number $minuend
     * @param           \Shrikeh\Precision\Number $subtrahend
     * @param null|int  $scale
     *
     * @return \Shrikeh\Precision\Number
     */
    public function subtract(Number $minuend, Number $subtrahend, $scale = null)
    {
        return $this->binary('subtract', $minuend, $subtrahend, $scale);
    }

    /**
     * Multiply one Number from another.
     *
     * @param           \Shrikeh\Precision\Number $multiplicand
     * @param           \Shrikeh\Precision\Number $multiplier
     * @param null|int  $scale
     *
     * @return \Shrikeh\Precision\Number
     */
    public function multiply(Number $multiplicand, Number $multiplier, $scale = null)
    {
        return $this->binary('multiply', $multiplicand, $multiplier, $scale);
    }

    /**
     * Divide one Number from another.
     *
     * @param           \Shrikeh\Precision\Number $dividend
     * @param           \Shrikeh\Precision\Number $divisor
     * @param null|int  $scale
     *
     * @return \Shrikeh\Precision\Number
     */
    public function divide(Number $dividend, Number $divisor, $scale = null)
    {
        return $this->binary('divide', $dividend, $divisor, $scale);
    }

    /**
     * Round a number to a certain scale.
     *
     * @param           \Shrikeh\Precision\Number $number
     * @param int       $scale
     *
     * @return \Shrikeh\Precision\Number
     */
    public function round(Number $number, $scale)
    {
        return $this->unary('round', $number, $scale);
    }

    /**
     * @return \Shrikeh\Precision\Number
     */
    public function zero()
    {
        if (!isset($this->zero)) {
            $this->zero = $this->getNumberFactory()->create(0);
        }
        return $this->zero;
    }

    /**
     * @return mixed
     */
    public function getNumberFactory()
    {
        return $this->numberFactory;
    }

    /**
     * @return array
     */
    public function getEngines()
    {
        return $this->engines;
    }

    /**
     * @param        $engineCallback
     * @param Number $number
     * @param        $scale
     *
     * @return mixed
     */
    private function unary($engineCallback, Number $number, $scale)
    {
        return $this->getEngine($number)->$engineCallback(
            $number,
            $this->scale($scale)
        );
    }

    /**
     * @param        $engineCallback
     * @param Number $leftNumber
     * @param Number $rightNumber
     * @param        $scale
     *
     * @return mixed
     */
    private function binary($engineCallback, Number $leftNumber, Number $rightNumber, $scale)
    {

        return $this->getEngine($leftNumber, $rightNumber)->$engineCallback(
            $leftNumber,
            $rightNumber,
            $this->scale($scale)
        );
    }

    /**
     * @return mixed
     */
    private function getEngine()
    {
        $numbers = func_get_args();
        foreach ($this->getEngines() as $engine) {
            if ($engine->validate($numbers)) {
                return $engine;
            }
        }
    }

    /**
     * @param callable $engine
     */
    private function addEngine(Closure $engine)
    {
        $engine->bindTo($this, $this);
        $this->engines[] = $engine($this);
    }

    /**
     * @param int|null $scale
     *
     * @return int
     */
    private function scale($scale = null)
    {
        if (null === $scale) {
            $scale = $this->getDefaultScale();
        }
        return (int) $scale;
    }
}
