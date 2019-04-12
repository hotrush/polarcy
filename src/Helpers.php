<?php

namespace Hotrush\Polarcy;

class Helpers
{
    /**
     * @param $x
     * @param $y
     * @return float
     */
    public static function radiusFromCoordinates($x, $y)
    {
        return sqrt(pow($x, 2) + pow($y, 2));
    }

    /**
     * @param $x
     * @param $y
     * @return float|int
     */
    public static function angleFromCoordinates($x, $y)
    {
        $angle = null;
        if ($x > 0) {
            if ($y >= 0) {
                $angle = atan2($y, $x);
            } else if ($y < 0) {
                $angle = atan2($y, $x) + 2 * M_PI;
            }
        } else if ($x < 0) {
            $angle = atan2($y, $x) + M_PI;
        } else if ($x === 0) {
            if ($y > 0) {
                $angle = M_PI / 2;
            } else if ($y < 0) {
                $angle = (3 * M_PI) / 2;
            } else {
                $angle = 0;
            }
        }

        if (is_null($angle)) {
            throw new \InvalidArgumentException('Can not calculate angle');
        }

        return $angle;
    }

    /**
     * @param $angle
     * @param $radius
     * @return float|int
     */
    public static function xFromPolar($angle, $radius)
    {
        return $radius * cos($angle);
    }

    /**
     * @param $angle
     * @param $radius
     * @return float|int
     */
    public static function yFromPolar($angle, $radius)
    {
        return $radius * sin($angle);
    }

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