<?php

namespace Maphpodon\models;

use Carbon\Carbon;

class Thumbnail extends Model
{
    public string $url;
    public string $blurhash;
    public array $versions;
}
