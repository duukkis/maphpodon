<?php

namespace Maphpodon\models;

class Context extends Model
{
    public array $ancestors = [];
    public array $descendants = [];
    public array $mapArrayToObjects = [
        "ancestors" => Status::class,
        "descendants" => Status::class,
    ];
}
