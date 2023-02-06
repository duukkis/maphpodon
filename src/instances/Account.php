<?php

namespace Maphpodon\instances;

use Carbon\Carbon;
use Maphpodon\helpers\Mapper;

class Account
{
    public string $id;
    public string $username;
    public string $acct;
    public string $display_name;
    public bool $locked;
    public bool $bot;
    public bool $discoverable;
    public bool $group;
    public string $created_at;
    public string $note;
    public string $url;
    public string $avatar;
    public string $avatar_static;
    public string $header;
    public string $header_static;
    public int $followers_count;
    public int $following_count;
    public int $statuses_count;
    public Carbon $last_status_at;
    public bool $noindex;
    public array $emojis;
    public array $fields;


    public static function build(\stdClass $item): Account
    {
        return Mapper::map($item, new Account());
    }
}