<?php

namespace Maphpodon\models;

class StatusSource extends Model
{
    public string $id;
    public string $text;
    public ?string $spoiler_text;
}
