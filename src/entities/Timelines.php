<?php

namespace Maphpodon\entities;

use Maphpodon\Maphpodon;

class Timelines
{
    public function __construct(protected Maphpodon $maphpodon)
    {

    }

    /**
     * @return array
     */
    public function public(): array
    {
        return $this->maphpodon->mapObjectToClassArray($this->maphpodon->get('timelines/public'), "Maphpodon\instances\Status");
    }
}