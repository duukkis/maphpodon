<?php

namespace Maphpodon\models\admin;

use Carbon\Carbon;
use Maphpodon\models\Account;
use Maphpodon\models\Model;
use Maphpodon\models\Status;

class AdminReport extends Model
{
    public string $id;
    public ?bool $action_taken;
    public ?Carbon $action_taken_at;
    public ?string $category;
    public ?string $comment;
    public ?bool $forwarded;
    public Carbon $created_at;
    public ?Carbon $updated_at;
    public Account $account;
    public ?Account $target_account;
    public ?AdminAccount $assigned_account;
    public ?AdminAccount $action_taken_by_account;
    public array $statuses = [];
    public array $rules;

    public array $mapArrayToObjects = [
        "statuses" => Status::class,
    ];
}
