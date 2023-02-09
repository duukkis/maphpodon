<?php

namespace Maphpodon\models;

class Application extends Model
{
    public string $id;
    public string $name;
    public ?string $website;
    public ?string $redirect_url;
    public ?string $client_id;
    public ?string $client_secret;
    public ?string $vapid_key;
}
