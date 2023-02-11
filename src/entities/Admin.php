<?php

namespace Maphpodon\entities;

use Maphpodon\entities\admin\Accounts;
use Maphpodon\entities\admin\DomainBlocks;
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

    public function domain_blocks(): DomainBlocks
    {
        return new DomainBlocks($this->maphpodon);
    }
}
