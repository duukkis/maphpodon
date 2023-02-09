<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\models\Account;
use Maphpodon\models\Model;
use Maphpodon\models\Status;
use Maphpodon\Maphpodon;

class Statuses
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#create
     * @param array $params
     * @return Status
     */
    public function post(array $params = []): Model|Status
    {
        $params = ["json" => $params];
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('v1/statuses', $params),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#get
     * @param string $id
     * @return Status
     */
    public function get(string $id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/statuses/%s', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#delete
     * @param string $id
     * @return Status
     */
    public function delete(string $id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->delete(sprintf('v1/statuses/%s', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#reblogged_by
     * @param $id
     * @return array
     */
    public function reblogged_by($id): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/statuses/%s/reblogged_by', $id), []),
            new Account()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#favourited_by
     * @param $id
     * @return array
     */
    public function favourited_by($id): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/statuses/%s/favourited_by', $id), []),
            new Account()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#favourite
     * @param $id
     * @return Status
     */
    public function favourite($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/favourite', $id), []),
            new Status()
        );
    }
}
