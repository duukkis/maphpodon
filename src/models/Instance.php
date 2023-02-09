<?php

namespace Maphpodon\models;

use Carbon\Carbon;

class Instance extends Model
{
    public string $domain;
    public string $title;
    public string $version;
    public string $source_url;
    public string $description;
    public array $usage = [];
    public Thumbnail $thumbnail;
    public array $languages = [];
    public Configuration $configuration;
    public array $registrations;
    public Contact $contact;
    public array $rules = [];

    public array $mapArrayToObjects = [
        "rules" => Rule::class,
    ];
}
