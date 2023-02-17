<?php

declare(strict_types=1);

namespace helpers;

use Maphpodon\helpers\Mapper;
use Maphpodon\models\Status;
use PHPUnit\Framework\TestCase;

final class MapperTest extends TestCase
{
    public function testMapItemWithNotSetValue(): void
    {
        $status = new Status();
        $jsonObject = \Safe\json_decode('{}');
        $actual = Mapper::map($jsonObject, clone $status);
        $this->assertEquals($status, $actual);
    }

    public function testMapItemWithSetValue(): void
    {
        $status = new Status();
        $jsonObject = \Safe\json_decode('{"id":"9"}');
        $actual = Mapper::map($jsonObject, clone $status);
        $this->assertEquals("9", $actual->id);
    }
}
