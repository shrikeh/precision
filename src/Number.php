<?php
namespace Shrikeh\Precision;

class Number
{
    const DEFAULT_SCALE = 2;

    const MAX_PRECISION = 12;

    private $value;

    private $scale;

    public function __construct($value, $scale = null)
    {
        $this->value = $value;
        if ($scale === null) {
            $scale = self::DEFAULT_SCALE;
        }
        if (!is_integer($scale)) {
            throw new \InvalidArgumentException("Scale $scale is not an integer");
        }
        $this->scale = (int) $scale;
    }

    public function __toString()
    {
        return $this->getValue();
    }

    public function getValue()
    {
        return $this->round(
            $this->value,
            $this->scale()
        );
    }

    public function getScale()
    {
        return $this->scale;
    }

    public function add(Number $precision, $scale = null)
    {
        $scale = $this->scale($scale);
        $result = bcadd(
            $this->value,
            $precision->getValue(),
            self::MAX_PRECISION
        );
        $diff = $this->round($result, $scale);
        return new self($diff, $scale);
    }

    public function sub(Number $precision, $scale = null)
    {
        $scale = $this->scale($scale);
        $result = bcsub(
            $this->value,
            $precision->getValue(),
            self::MAX_PRECISION
        );
        $diff = $this->round($result, $scale);
        return new self($diff, $scale);
    }

    public function divide(Number $precision, $scale = null)
    {
        $scale = $this->scale($scale);
        $result = bcdiv(
            $this->value,
            $precision->getValue(),
            self::MAX_PRECISION
        );
        $diff = $this->round($result, $scale);
        return new self($diff, $scale);
    }

    public function multiply(Number $precision, $scale = null)
    {
        $scale = $this->scale($scale);
        $result = bcmul(
            $this->value,
            $precision->getValue(),
            self::MAX_PRECISION
        );
        $diff = $this->round($result, $scale);
        return new self($diff, $scale);
    }

    private function round($number, $scale = 0)
    {
        $fix = '5';
        for ($i=0; $i<$scale; $i++) {
            $fix = "0$fix";
        }
        $number = bcadd($number, "0.$fix", $scale + 1);
        return bcdiv($number, "1.0", $scale);
    }

    private function scale($scale = null)
    {
        if (null === $scale) {
            $scale = $this->getScale();
        }
        return (int) $scale;
    }


    private function trim($value)
    {
        list($whole, $decimal) = explode('.', $value);
        $decimal = rtrim($decimal, '0');
        if ($decimal) {
            $decimal = ".$decimal";
        }
        return "$whole$decimal";

    }


}