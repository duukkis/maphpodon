<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\models\Application;
use Maphpodon\Maphpodon;
use Maphpodon\models\Model;

class Apps
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    public function post(array $params): Model|Application
    {
        $params = ["json" => $params];
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('v1/apps', $params),
            new Application()
        );
    }

    public function verify_credentials(): Model|Application
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get('v1/apps/verify_credentials', []),
            new Application()
        );
    }
}
