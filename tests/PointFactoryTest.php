<?php

namespace Hotrush\Polarcy\Tests;

use Hotrush\Polarcy\Point;
use Hotrush\Polarcy\PointFactory;
use PHPUnit\Framework\TestCase;

class PointFactoryTest extends TestCase
{
    public function testPointFactoryFromCoords()
    {
        $point = PointFactory::createFromCoordinates(1, 2);

        $this->assertInstanceOf(Point::class, $point);
        $this->assertEquals(1, $point->x());
        $this->assertEquals(2, $point->y());
        $this->assertNotNull($point->radius());
        $this->assertNotNull($point->angle());
    }

    public function testPointFactoryFromPolar()
    {
        $point = PointFactory::createFromPolar(1, 2);

        $this->assertInstanceOf(Point::class, $point);
        $this->assertEquals(1, $point->angle());
        $this->assertEquals(2, $point->radius());
        $this->assertNotNull($point->x());
        $this->assertNotNull($point->y());
    }
}