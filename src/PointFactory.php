<?php

namespace Hotrush\Polarcy;

class PointFactory
{
    /**
     * @param $x
     * @param $y
     * @return Point
     */
    public static function createFromCoordinates($x, $y)
    {
        $radius = Helpers::radiusFromCoordinates($x, $y);
        $angle = Helpers::angleFromCoordinates($x, $y);

        return new Point($x, $y, $angle, $radius);
    }

    /**
     * @param $angle
     * @param $radius
     * @return Point
     */
    public static function createFromPolar($angle, $radius)
    {
        $x = Helpers::xFromPolar($angle, $radius);
        $y = Helpers::yFromPolar($angle, $radius);

        return new Point($x, $y, $angle, $radius);
    }
}