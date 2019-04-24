<?php

namespace Hotrush\Polarcy\Tests;

use Hotrush\Polarcy\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testPointClass()
    {
        $point = new Point(1, 2);

        $this->assertInstanceOf(Point::class, $point);
        $this->assertEquals(1, $point->x());
        $this->assertEquals(2, $point->y());
    }
}