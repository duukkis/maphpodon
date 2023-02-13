<?php

namespace Maphpodon\models;

use Carbon\Carbon;

class StatusEdit extends Model
{
    public string $content;
    public string $spoiler_text;
    public bool $sensitive;
    public Carbon $created_at;
    public Account $account;
    public array $media_attachments = [];
    public array $emojis = [];

    public array $mapArrayToObjects = [
        "media_attachments" => MediaAttachment::class,
    ];
}
