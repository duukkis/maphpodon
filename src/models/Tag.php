<?php

namespace Maphpodon\models;

class Tag extends Model
{
    public string $name;
    public string $url;
    public bool $following;
    public array $history = [];

    public array $mapArrayToObjects = [
        "history" => History::class,
    ];
}
