<?php

namespace Maphpodon\instances;

use Carbon\Carbon;
use Maphpodon\helpers\Mapper;

abstract class Model
{
    public static function build(\stdClass $item, Model $model): self
    {
        return Mapper::map($item, $model);
    }
}