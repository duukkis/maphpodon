<?php

namespace Maphpodon\entities;

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
            "accounts" => $this->maphpodon->mapObjectToClassArray(
                $result->accounts ?? [],
                new Account()
            ),
            "statuses" => $this->maphpodon->mapObjectToClassArray(
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