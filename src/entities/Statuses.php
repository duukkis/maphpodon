<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\instances\Status;
use Maphpodon\Maphpodon;

class Statuses
{
    public function __construct(protected Maphpodon $maphpodon)
    {

    }

    public function post(array $params = []): Status
    {
        $params = Mapper::cleanParams(
            $params,
            ["status", "media_ids[]", "poll[options][]", "poll[expires_in]", "poll[multiple]", "poll[hide_totals]", "in_reply_to_id", "sensitive", "spoiler_text", "visibility", "language", "scheduled_at"]
        );
        $params = ["json" => $params];
        return $this->maphpodon->mapObjectToClass(
            $this->maphpodon->post('statuses', $params),
            new Status()
        );
    }

    public function get(string $id): Status
    {
        return $this->maphpodon->mapObjectToClass(
            $this->maphpodon->get(sprintf('statuses/%s', $id), []),
            new Status()
        );
    }

    public function delete(string $id): Status
    {
        return $this->maphpodon->mapObjectToClass(
            $this->maphpodon->delete(sprintf('statuses/%s', $id), []),
            new Status()
        );
    }
}