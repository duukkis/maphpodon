<?php

namespace Maphpodon\models;

use Carbon\Carbon;
use Maphpodon\helpers\Mapper;

class MediaAttachment extends Model
{
    public string $id;
    public string $type;
    public string $url;
    public string $preview_url;
    public ?string $remote_url;
    public ?string $text_url;
    public array $meta;
    public ?string $description;
    public ?string $blurhash;
}
