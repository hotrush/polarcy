<?php

namespace Hotrush\Polarcy\Tests;

use Hotrush\Polarcy\Point;
use Hotrush\Polarcy\PointsCollection;
use PHPUnit\Framework\TestCase;

class PointsCollectionTest extends TestCase
{
    public function testPointsCollectionClass()
    {
        $collection = new PointsCollection();

        $this->assertInstanceOf(PointsCollection::class, $collection);
        $this->assertEquals(0, $collection->total());
        $this->assertEmpty($collection->all());

        for ($i = 1; $i <= 3; $i++) {
            $collection->add(new Point($i, $i + 1, $i + 2, $i + 3));
        }

        $this->assertEquals(3, $collection->total());
        $this->assertIsArray($collection->all());
        $this->assertNotEmpty($collection->all());
    }
}