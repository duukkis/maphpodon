<?php

namespace Maphpodon\models;

class SearchResult extends Model
{
    public array $accounts = [];
    public array $statuses = [];
    public array $hashtags = [];
    public array $mapArrayToObjects = [
        "accounts" => Account::class,
        "statuses" => Status::class,
        "hashtags" => Tag::class,
    ];
}
