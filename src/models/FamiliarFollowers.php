<?php

namespace Maphpodon\models;

class FamiliarFollowers extends Model
{
    public array $id = [];
    public array $accounts = [];
    public array $mapArrayToObjects = [
        "accounts" => Account::class,
    ];
}
