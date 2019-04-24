<?php

namespace Hotrush\Polarcy\Tests;

use Hotrush\Polarcy\Point;
use Hotrush\Polarcy\PointsCollection;
use Hotrush\Polarcy\Polarcy;
use PHPUnit\Framework\TestCase;

class CalculationsTest extends TestCase
{
    public function testCalculations1()
    {
        $collection = new PointsCollection();
        $collection->add(new Point(136, -140));
        $collection->add(new Point(-268, -3));

        $polarcy = new Polarcy($collection);

        $this->assertEquals(-66, $polarcy->averagePoint()->x());
        $this->assertEquals(-71.5, $polarcy->averagePoint()->y());
        $this->assertEquals(50, $polarcy->accuracy());
    }
}