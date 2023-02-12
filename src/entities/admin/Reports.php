<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminReport;
use Maphpodon\models\Model;

class Reports
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/reports/#get
     * @param array $params
     * @return AdminReport[]
     */
    public function list(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/reports', $params),
            new AdminReport()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/reports/#get-one
     * @param string $id
     * @return AdminReport
     */
    public function view(string $id): Model|AdminReport
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/admin/reports/%s', $id), []),
            new AdminReport()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/reports/#update
     * @param string $id
     * @param array $params
     * @return AdminReport
     */
    public function update(string $id, array $params = []): Model|AdminReport
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->put(sprintf('v1/admin/reports/%s', $id), $params),
            new AdminReport()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/reports/#assign_to_self
     * @param string $id
     * @return AdminReport
     */
    public function assign_to_self(string $id): Model|AdminReport
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/reports/%s/assign_to_self', $id), []),
            new AdminReport()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/reports/#unassign
     * @param string $id
     * @return AdminReport
     */
    public function unassign(string $id): Model|AdminReport
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/reports/%s/unassign', $id), []),
            new AdminReport()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/reports/#resolve
     * @param string $id
     * @return AdminReport
     */
    public function resolve(string $id): Model|AdminReport
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/reports/%s/resolve', $id), []),
            new AdminReport()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/reports/#reopen
     * @param string $id
     * @return AdminReport
     */
    public function reopen(string $id): Model|AdminReport
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/reports/%s/reopen', $id), []),
            new AdminReport()
        );
    }
}
