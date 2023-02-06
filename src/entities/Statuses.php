<?php

namespace Maphpodon\entities;

use Maphpodon\Maphpodon;

class Statuses
{
    public function __construct(protected Maphpodon $maphpodon)
    {

    }

    public function index()
    {
        return $this->maphpodon->get('statuses');
    }
}