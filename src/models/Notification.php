<?php

namespace Maphpodon\models;

use Carbon\Carbon;

class Notification extends Model
{
    public string $id;
    public string $type;
    public Carbon $created_at;
    public Account $account;
    public Status $status;
}
