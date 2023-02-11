<?php

namespace Maphpodon\entities;

use Maphpodon\entities\admin\Accounts;
use Maphpodon\Maphpodon;

class Admin
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    public function accounts(): Accounts
    {
        return new Accounts($this->maphpodon);
    }
}