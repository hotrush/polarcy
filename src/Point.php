<?php

namespace Hotrush\Polarcy;

class Point
{
    /**
     * @var float
     */
    private $x;

    /**
     * @var float
     */
    private $y;

    /**
     * Point constructor.
     *
     * @param mixed $x
     * @param mixed $y
     */
    public function __construct($x, $y)
    {
        $this->x = floatval($x);
        $this->y = floatval($y);
    }

    /**
     * @return float
     */
    public function x()
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function y()
    {
        return $this->y;
    }
}