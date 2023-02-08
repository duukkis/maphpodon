<?php

namespace Maphpodon\models;

use Carbon\Carbon;

class Field extends Model
{
    public string $name;
    public string $value;
    public ?Carbon $vefified_at;
}
