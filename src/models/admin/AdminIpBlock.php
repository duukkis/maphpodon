<?php

namespace Maphpodon\models\admin;

use Carbon\Carbon;
use Maphpodon\models\Model;

class AdminIpBlock extends Model
{
    public string $id;
    public string $ip;
    public ?string $severity;
    public ?string $comment;
    public Carbon $created_at;
    public ?Carbon $expires_at;
}
