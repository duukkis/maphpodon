<?php

namespace Maphpodon\models\admin;

use Carbon\Carbon;
use Maphpodon\models\Account;
use Maphpodon\models\Model;

class AdminAccount extends Model
{
    public string $id;
    public string $username;
    public ?string $domain;
    public Carbon $created_at;
    public ?string $email;
    public ?string $ip;
    public ?AdminRole $role;
    public ?bool $confirmed;
    public ?bool $suspended;
    public ?bool $silenced;
    public ?bool $disabled;
    public ?bool $approved;
    public ?string $locale;
    public ?string $invite_request;
    public ?array $ips;
    public Account $account;
}
