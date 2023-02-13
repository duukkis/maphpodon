<?php

namespace Maphpodon\models\admin;

use Carbon\Carbon;
use Maphpodon\models\Model;

class AdminCohort extends Model
{
    public Carbon $period;
    public ?string $frequency;
    public array $data;
}
