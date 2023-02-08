<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\instances\Account;
use Maphpodon\instances\Status;
use Maphpodon\Maphpodon;
class Search
{
    public function __construct(protected Maphpodon $maphpodon)
    {

    }

    /**
     * @link https://docs.joinmastodon.org/methods/search/#v2
     * @TODO populate a typed SearchResult
     * @param array $params
     * @return array
     */
    public function get(array $params): array
    {
        $result = $this->maphpodon->get('v2/search', ["query" => $params]);
        return [
            "accounts" => Mapper::mapJsonObjectToClassArray(
                $result->accounts ?? [],
                new Account()
            ),
            "statuses" => Mapper::mapJsonObjectToClassArray(
                $result->statuses ?? [],
                new Status()
            ),
            /*
            "hashtags" => $this->maphpodon->mapObjectToClassArray(
                $result->hashtags,
                new HashTag()
            ),
            */
        ];
    }
}