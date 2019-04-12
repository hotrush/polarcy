<?php

namespace Hotrush\Polarcy;

class PointsCollection
{
    /**
     * @var Point[]
     */
    private $points = [];

    /**
     * @param Point $point
     * @return $this
     */
    public function add(Point $point)
    {
        $this->points[] = $point;

        return $this;
    }

    /**
     * @return Point[]
     */
    public function all()
    {
        return $this->points;
    }

    /**
     * @return int
     */
    public function total()
    {
        return count($this->points);
    }
}