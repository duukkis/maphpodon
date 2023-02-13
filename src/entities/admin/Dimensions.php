<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminKey;

class Dimensions
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/dimensions/#get
     * @param array $params
     * @return AdminKey[]
     */
    public function list(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->post('v1/admin/dimensions', $params),
            new AdminKey()
        );
    }
}
