<?php

namespace Maphpodon\entities;

use Maphpodon\entities\admin\Accounts;
use Maphpodon\entities\admin\CanonicalEmailBlocks;
use Maphpodon\entities\admin\Dimensions;
use Maphpodon\entities\admin\DomainAllows;
use Maphpodon\entities\admin\DomainBlocks;
use Maphpodon\entities\admin\IpBlocks;
use Maphpodon\entities\admin\Measures;
use Maphpodon\entities\admin\Reports;
use Maphpodon\entities\admin\Retention;
use Maphpodon\entities\admin\Trends;
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

    public function domain_allows(): DomainAllows
    {
        return new DomainAllows($this->maphpodon);
    }

    public function reports(): Reports
    {
        return new Reports($this->maphpodon);
    }

    public function trends(): Trends
    {
        return new Trends($this->maphpodon);
    }

    public function canonical_email_blocks(): CanonicalEmailBlocks
    {
        return new CanonicalEmailBlocks($this->maphpodon);
    }

    public function dimensions(): Dimensions
    {
        return new Dimensions($this->maphpodon);
    }

    public function ip_blocks(): IpBlocks
    {
        return new IpBlocks($this->maphpodon);
    }

    public function measures(): Measures
    {
        return new Measures($this->maphpodon);
    }

    public function retention(): Retention
    {
        return new Retention($this->maphpodon);
    }
}
