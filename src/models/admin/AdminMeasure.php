<?php

namespace Maphpodon\models\admin;

use Maphpodon\models\Model;

class AdminMeasure extends Model
{
    public string $key;
    public ?string $unit;
    public ?string $total;
    public ?string $previous_total;
    public array $data;
}
