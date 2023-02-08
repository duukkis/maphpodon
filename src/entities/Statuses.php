<?php

namespace Maphpodon\entities;

use Maphpodon\instances\Account;
use Maphpodon\instances\Status;
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
    public function post(array $params = []): Status
    {
        $params = ["json" => $params];
        return $this->maphpodon->mapObjectToClass(
            $this->maphpodon->post('v1/statuses', $params),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#get
     * @param string $id
     * @return Status
     */
    public function get(string $id): Status
    {
        return $this->maphpodon->mapObjectToClass(
            $this->maphpodon->get(sprintf('v1/statuses/%s', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#delete
     * @param string $id
     * @return Status
     */
    public function delete(string $id): Status
    {
        return $this->maphpodon->mapObjectToClass(
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
        return $this->maphpodon->mapObjectToClassArray(
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
        return $this->maphpodon->mapObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/statuses/%s/favourited_by', $id), []),
            new Account()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#favourite
     * @param $id
     * @return Status
     */
    public function favourite($id): Status
    {
        return $this->maphpodon->mapObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/favourite', $id), []),
            new Status()
        );
    }
}