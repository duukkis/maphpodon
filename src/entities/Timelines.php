<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\instances\Status;
use Maphpodon\Maphpodon;

class Timelines
{
    public function __construct(protected Maphpodon $maphpodon)
    {

    }

    /**
     * @return Status[]
     */
    public function public(array $params =  []): array
    {
        $params = Mapper::cleanParams(
            $params,
            ["local", "remote", "only_media", "max_id", "since_id", "min_id", "limit"]
        );
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/timelines/public', ["query" => $params]),
            new Status()
        );
    }

    /**
     * @return Status[]
     */
    public function home(array $params =  []): array
    {
        $params = Mapper::cleanParams(
            $params,
            ["max_id", "since_id", "min_id", "limit"]
        );
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/timelines/home', ["query" => $params]),
            new Status()
        );
    }

    /**
     * @return Status[]
     */
    public function tag(string $tag, array $params = []): array
    {
        $params = Mapper::cleanParams(
            $params,
            ["any", "all", "none", "local", "remote", "only_media", "max_id", "since_id", "min_id", "limit"]
        );
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/timelines/tag/' . $tag, ["query" => $params]),
            new Status()
        );
    }
}