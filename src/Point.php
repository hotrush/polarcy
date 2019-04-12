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
     * @var float
     */
    private $angle;

    /**
     * @var float
     */
    private $radius;

    /**
     * Point constructor.
     *
     * @param mixed $x
     * @param mixed $y
     * @param mixed $angle in radian
     * @param mixed $radius
     */
    public function __construct($x, $y, $angle, $radius)
    {
        $this->x = floatval($x);
        $this->y = floatval($y);
        $this->angle = floatval($angle);
        $this->radius = floatval($radius);
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

    /**
     * @return float
     */
    public function angle()
    {
        return $this->angle;
    }

    /**
     * @return float
     */
    public function radius()
    {
        return $this->radius;
    }
}