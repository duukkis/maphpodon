<?php

namespace Maphpodon\models;

class Token extends Model
{
    public string $access_token;
    public string $token_type;
    public string $scope;
    public string $created_at;
}
