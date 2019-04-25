<?php

namespace Hotrush\Polarcy;

class Polarcy
{
    /**
     * @var PointsCollection
     */
    private $pointsCollection;

    /**
     * @var Point
     */
    private $averagePoint;

    /**
     * @var float
     */
    private $accuracy;

    /**
     * @var float|int
     */
    private $maxDistance;

    /**
     * @var float|int
     */
    private $minPerPoint;

    /**
     * Polarcy constructor.
     *
     * @param PointsCollection $pointsCollection
     * @param null $maxDistance
     * @param null $minPerPoint
     */
    public function __construct(PointsCollection $pointsCollection, $maxDistance = null, $minPerPoint = null)
    {
        if ($pointsCollection->total() < 2) {
            throw new \InvalidArgumentException('PointsCollection must have at least two points');
        }

        $this->pointsCollection = $pointsCollection;
        $this->maxDistance = $maxDistance;
        $this->minPerPoint = $minPerPoint ?: $this->minPerPoint();
    }

    /**
     * @return Point
     */
    public function averagePoint()
    {
        if (!$this->averagePoint) {
            $this->calculate();
        }

        return $this->averagePoint;
    }

    /**
     * @return float
     */
    public function accuracy()
    {
        if (!$this->accuracy) {
            $this->calculate();
        }

        return $this->accuracy;
    }

    /**
     * Run the calculations
     *
     * @return void
     */
    public function calculate()
    {
        $this->calculateAveragePoint();
        $this->calculateAccuracy();
    }

    /**
     * @return float|int
     */
    private function minPerPoint()
    {
        return 100 / pow($this->pointsCollection->total(), 2);
    }

    /**
     * @return void
     */
    private function calculateAveragePoint()
    {
        $xSum = array_sum(array_map(function (Point $point) {
            return $point->x();
        }, $this->pointsCollection->all()));
        $ySum = array_sum(array_map(function (Point $point) {
            return $point->y();
        }, $this->pointsCollection->all()));

        $this->averagePoint = new Point(
            $xSum / $this->pointsCollection->total(),
            $ySum / $this->pointsCollection->total()
        );
    }

    /**
     * @return void
     */
    private function calculateAccuracy()
    {
        $maxPerPoint = 100 / $this->pointsCollection->total();
        $distances = [];

        foreach ($this->pointsCollection->all() as $point) {
            $distances[] = Helpers::distanceBetweenPoints($point, $this->averagePoint);
        }

        if (!$this->maxDistance) {
            rsort($distances, SORT_NUMERIC);
            $this->maxDistance = $distances[0];
        }

        if ($this->maxDistance > 0) {
            foreach ($distances as $distance) {
                $remoteness = ($this->maxDistance - $distance) / $this->maxDistance;
                $this->accuracy += $remoteness > 0 ? $remoteness * $maxPerPoint : $this->minPerPoint;
            }
        } else {
            $this->accuracy = 100;
        }
    }
}