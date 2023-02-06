<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;

class Timelines
{
    public function __construct(protected Maphpodon $maphpodon)
    {

    }

    /**
     * @return array
     */
    public function public(array $params =  []): array
    {
        $params = Mapper::cleanParams(
            $params,
            ["local", "remote", "only_media", "max_id", "since_id", "min_id", "limit"]
        );
        return $this->maphpodon->mapObjectToClassArray(
            $this->maphpodon->get('timelines/public', ["query" => $params]),
            "Maphpodon\instances\Status"
        );
    }

    public function home(array $params =  []): array
    {
        $params = Mapper::cleanParams(
            $params,
            ["max_id", "since_id", "min_id", "limit"]
        );
        return $this->maphpodon->mapObjectToClassArray(
            $this->maphpodon->get('timelines/home', ["query" => $params]),
            "Maphpodon\instances\Status"
        );
    }
    
    public function tag(string $tag, array $params = []): array
    {
        $params = Mapper::cleanParams(
            $params,
            ["any[]", "all[]", "none[]", "local", "remote", "only_media", "max_id", "since_id", "min_id", "limit"]
        );
        return $this->maphpodon->mapObjectToClassArray(
            $this->maphpodon->get('timelines/tag/' . $tag, ["query" => $params]),
            "Maphpodon\instances\Status"
        );
    }
}