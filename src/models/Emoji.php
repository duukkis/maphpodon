<?php

namespace Maphpodon\models;

class Emoji extends Model
{
    public string $shortcode;
    public string $url;
    public string $static_url;
    public bool $visible_in_picker;
}
