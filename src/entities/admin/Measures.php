<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminMeasure;

class Measures
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/measures/#get
     * @param array $params
     * @return AdminMeasure[]
     */
    public function list(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->post('v1/admin/measures', $params),
            new AdminMeasure()
        );
    }
}
