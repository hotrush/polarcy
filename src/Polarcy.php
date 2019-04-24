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
    private $minPerPoint;

    /**
     * Polarcy constructor.
     *
     * @param PointsCollection $pointsCollection
     * @param null $minPerPoint
     */
    public function __construct(PointsCollection $pointsCollection, $minPerPoint = null)
    {
        if ($pointsCollection->total() < 2) {
            throw new \InvalidArgumentException('PointsCollection must have at least two points');
        }

        $this->pointsCollection = $pointsCollection;
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
        $radiusSum = array_sum(array_map(function (Point $point) {
            return $point->radius();
        }, $this->pointsCollection->all()));
        $anglesSum = array_sum(array_map(function (Point $point) {
            return $point->angle();
        }, $this->pointsCollection->all()));

        $this->averagePoint = PointFactory::createFromPolar(
            $anglesSum / $this->pointsCollection->total(),
            $radiusSum / $this->pointsCollection->total()
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

        rsort($distances, SORT_NUMERIC);

        $maxDistance = $distances[0];

        if ($maxDistance > 0) {
            foreach ($distances as $distance) {
                $remoteness = ($maxDistance - $distance) / $maxDistance;
                $this->accuracy += $remoteness > 0 ? $remoteness * $maxPerPoint : $this->minPerPoint;
            }
        } else {
            $this->accuracy = 100;
        }
    }
}