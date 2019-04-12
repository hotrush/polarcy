<?php

namespace Hotrush\Polarcy\Tests;

use Hotrush\Polarcy\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testPointClass()
    {
        $point = new Point(1, 2, 3, 4);

        $this->assertInstanceOf(Point::class, $point);
        $this->assertEquals(1, $point->x());
        $this->assertEquals(2, $point->y());
        $this->assertEquals(3, $point->angle());
        $this->assertEquals(4, $point->radius());
    }
}