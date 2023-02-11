<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\models\Model;
use Maphpodon\models\SearchResult;
use Maphpodon\Maphpodon;

class Search
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/search/#v2
     * @param array $params
     * @return SearchResult
     */
    public function get(array $params): Model|SearchResult
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get('v2/search', $params),
            new SearchResult()
        );
    }
}
