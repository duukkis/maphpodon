<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\Model;
use Maphpodon\models\Poll;

class Polls
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/polls/#get
     * @param string $id
     * @return Poll
     */
    public function get(string $id): Model|Poll
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/polls/%s', $id), []),
            new Poll()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/polls/#vote
     * @param string $id
     * @param array $params
     * @return Poll
     */
    public function vote(string $id, array $params = []): Model|Poll
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/polls/%s/votes', $id), $params),
            new Poll()
        );
    }
}
