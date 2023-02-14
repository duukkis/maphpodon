<?php

namespace Maphpodon\models;

use Carbon\Carbon;

class Poll extends Model
{
    public string $id;
    public ?Carbon $expires_at;
    public bool $expired;
    public bool $multiple;
    public int $votes_count;
    public ?int $voters_count;
    public bool $voted;
    public array $own_votes;
    public array $options = [];
    public array $emojis = [];

    public array $mapArrayToObjects = [
        "options" => PollOption::class,
    ];
}
