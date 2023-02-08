<?php

namespace Maphpodon\models;

class Relationship extends Model
{
    public string $id;
    public bool $following;
    public bool $showing_reblogs;
    public bool $notifying;
    public bool $followed_by;
    public bool $blocking;
    public bool $blocked_by;
    public bool $muting;
    public bool $muting_notifications;
    public bool $requested;
    public bool $endorsed;
    public ?string $note;
}
