<?php

namespace Hotrush\Polarcy\Tests;

use Hotrush\Polarcy\Point;
use Hotrush\Polarcy\PointsCollection;
use Hotrush\Polarcy\Polarcy;
use PHPUnit\Framework\TestCase;

class PolarcyTest extends TestCase
{
    public function testPolarcyCreationError()
    {
        $emptyCollection = new PointsCollection();

        $this->expectException(\InvalidArgumentException::class);
        new Polarcy($emptyCollection);
    }

    public function testPolarcyCreation()
    {
        $collection = new PointsCollection();
        for ($i = 1; $i <= 3; $i++) {
            $collection->add(new Point($i, $i + 1, $i + 2, $i + 3));
        }
        $polarcy = new Polarcy($collection);

        $this->assertInstanceOf(Point::class, $polarcy->averagePoint());
        $this->assertNotNull($polarcy->averagePoint()->x());
        $this->assertNotNull($polarcy->averagePoint()->y());
        $this->assertNotNull($polarcy->accuracy());
    }
}