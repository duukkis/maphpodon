<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\instances\Notification;
use Maphpodon\Maphpodon;
class Notifications
{
    public function __construct(protected Maphpodon $maphpodon)
    {

    }

    /**
     * @link https://docs.joinmastodon.org/methods/notifications/#get
     * @param array $params
     * @return Notification[]
     */
    public function index(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/notifications', ["query" => $params]),
            new Notification()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/notifications/#get-one
     * @param string $id
     * @return Notification
     */
    public function get(string $id): Notification
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/notifications/%s', $id), []),
            new Notification()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/notifications/#clear
     * @return void
     */
    public function clear(): void
    {
        $this->maphpodon->post('v1/notifications/clear', []);
    }


}