<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\Link;
use Maphpodon\models\Status;
use Maphpodon\models\Tag;

class Trends
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * https://docs.joinmastodon.org/methods/admin/trends/#links
     * @param array $params
     * @return Link[]
     */
    public function links(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/trends/links', $params),
            new Link()
        );
    }

    /**
     * https://docs.joinmastodon.org/methods/admin/trends/#statuses
     * @param array $params
     * @return Status[]
     */
    public function statuses(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/trends/statuses', $params),
            new Status()
        );
    }

    /**
     * https://docs.joinmastodon.org/methods/admin/trends/#tags
     * @param array $params
     * @return Tag[]
     */
    public function tags(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/trends/tags', $params),
            new Tag()
        );
    }
}
