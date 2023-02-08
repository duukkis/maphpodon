<?php

namespace Maphpodon\instances;
use Carbon\Carbon;

class Instance extends Model
{
    public string $domain;
    public string $title;
    public string $version;
    public string $source_url;
    public string $description;
    // TODO plenty of fields and items
}
