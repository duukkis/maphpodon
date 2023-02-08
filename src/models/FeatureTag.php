<?php

namespace Maphpodon\models;

use Carbon\Carbon;

class FeatureTag extends Model
{
    public string $id;
    public string $name;
    public int $statuses_count;
    public ?Carbon $last_status_at;
}
