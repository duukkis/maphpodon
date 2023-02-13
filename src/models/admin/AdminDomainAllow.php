<?php

namespace Maphpodon\models\admin;

use Carbon\Carbon;
use Maphpodon\models\Model;

class AdminDomainAllow extends Model
{
    public string $id;
    public string $domain;
    public Carbon $created_at;
}
