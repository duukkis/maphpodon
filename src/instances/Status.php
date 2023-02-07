<?php

namespace Maphpodon\instances;

use Carbon\Carbon;
use Maphpodon\helpers\Mapper;

class Status extends Model
{
    public string $id;
    public Carbon $created_at;
    public ?string $in_reply_to_id;
    public ?string $in_reply_to_account_id;
    public bool $sensitive;
    public string $spoiler_text;
    public string $visibility;
    public string $language;
    public string $uri;
    public string $url;
    public int $replies_count;
    public int $reblogs_count;
    public int $favourites_count;
    public ?Carbon $edited_at;
    public string $content;
    public ?string $reblog;
    public array $application;
    public Account $account;
    public array $media_attachments;
    public array $mentions;
    public array $tags;
    public array $emojis;
    public ?string $card;
    public ?string $poll;
}