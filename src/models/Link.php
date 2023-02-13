<?php

namespace Maphpodon\models;

class Link extends Model
{
    public string $url;
    public string $title;
    public ?string $description;
    public string $type;
    public ?string $author_name;
    public ?string $author_url;
    public ?string $provider_name;
    public ?string $provider_url;
    public ?string $html;
    public int $width;
    public int $height;
    public ?string $image;
    public ?string $embed_url;
    public ?string $blurhash;
    public ?array $history;
}
