<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\Instance as InstanceModel;

class Instance
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/instance/#v2
     * @return InstanceModel
     */
    public function index(): InstanceModel
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get('v2/instance', []),
            new InstanceModel()
        );
    }
}
