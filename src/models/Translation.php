<?php

namespace Maphpodon\models;

class Translation extends Model
{
    public ?string $content;
    public ?string $detected_source_language;
    public ?string $provider;
}
