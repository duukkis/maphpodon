<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\models\Status;
use Maphpodon\Maphpodon;

class Timelines
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/timelines/#public
     * @param array $params
     * @return array
     */
    public function public(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/timelines/public', $params),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/timelines/#home
     * @param array $params
     * @return array
     */
    public function home(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/timelines/home', $params),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/timelines/#tag
     * @param string $tag
     * @param array $params
     * @return array
     */
    public function tag(string $tag, array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/timelines/tag/' . $tag, $params),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/timelines/#list
     * @param string $id
     * @param array $params
     * @return array
     */
    public function list(string $id, array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/timelines/list/%s', $id), $params),
            new Status()
        );
    }
}
