<?php

namespace Maphpodon\models;

class Contact extends Model
{
    public string $email;
    public Account $account;
}
