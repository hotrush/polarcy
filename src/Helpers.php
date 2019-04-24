<?php

namespace Hotrush\Polarcy;

class Helpers
{
    /**
     * @param Point $point1
     * @param Point $point2
     * @return float
     */
    public static function distanceBetweenPoints(Point $point1, Point $point2)
    {
        return sqrt(pow($point1->x() - $point2->x(), 2) + pow($point1->y() - $point2->y(), 2));
    }
}