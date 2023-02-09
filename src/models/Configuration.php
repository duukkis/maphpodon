<?php

namespace Maphpodon\models;

class Configuration extends Model
{
    public array $urls = [];
    public array $accounts = [];
    public array $statuses = [];
    public array $media_attachments = [];
    public array $polls = [];
    public array $translation = [];
}
