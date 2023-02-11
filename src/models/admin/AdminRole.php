<?php

namespace Maphpodon\models\admin;

use Maphpodon\models\Model;

class AdminRole extends Model
{
    public string $id;
    public ?string $name;
    public string $permissions;
    public ?string $color;
    public ?bool $highlighted;
}
