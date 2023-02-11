<?php

namespace Maphpodon\entities;

use Maphpodon\entities\admin\Accounts;
use Maphpodon\Maphpodon;

class Admin
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    public function accounts(){
        return new Accounts($this->maphpodon);
    }
}
