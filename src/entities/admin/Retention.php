<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminCohort;

class Retention
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/retention/#create
     * @param array $params
     * @return AdminCohort[]
     */
    public function list(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->post('v1/admin/measures', $params),
            new AdminCohort()
        );
    }
}
