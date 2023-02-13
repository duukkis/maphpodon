<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\models\Account;
use Maphpodon\models\Context;
use Maphpodon\models\Model;
use Maphpodon\models\Status;
use Maphpodon\Maphpodon;
use Maphpodon\models\StatusEdit;
use Maphpodon\models\StatusSource;
use Maphpodon\models\Translation;

class Statuses
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#create
     * @param array $params
     * @return Status
     */
    public function post(array $params = []): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('v1/statuses', $params),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#get
     * @param string $id
     * @return Status
     */
    public function get(string $id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/statuses/%s', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#delete
     * @param string $id
     * @return Status
     */
    public function delete(string $id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->delete(sprintf('v1/statuses/%s', $id)),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#context
     * @param string $id
     * @return Context
     */
    public function context(string $id): Model|Context
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/statuses/%s/context', $id), []),
            new Context()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#translate
     * @param string $id
     * @param array $params
     * @return Translation
     */
    public function translate(string $id, array $params = []): Model|Translation
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/translate', $id), $params),
            new Translation()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#reblogged_by
     * @param $id
     * @return array
     */
    public function reblogged_by($id): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/statuses/%s/reblogged_by', $id), []),
            new Account()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#favourited_by
     * @param $id
     * @return array
     */
    public function favourited_by($id): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/statuses/%s/favourited_by', $id), []),
            new Account()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#favourite
     * @param $id
     * @return Status
     */
    public function favourite($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/favourite', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#unfavourite
     * @param $id
     * @return Status
     */
    public function unfavourite($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/unfavourite', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#boost
     * @param $id
     * @return Status
     */
    public function reblog($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/reblog', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#unreblog
     * @param $id
     * @return Status
     */
    public function unreblog($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/unreblog', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#bookmark
     * @param $id
     * @return Status
     */
    public function bookmark($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/bookmark', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#unbookmark
     * @param $id
     * @return Status
     */
    public function unbookmark($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/unbookmark', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#mute
     * @param $id
     * @return Status
     */
    public function mute($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/mute', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#unmute
     * @param $id
     * @return Status
     */
    public function unmute($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/unmute', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#pin
     * @param $id
     * @return Status
     */
    public function pin($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/pin', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#unpin
     * @param $id
     * @return Status
     */
    public function unpin($id): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/statuses/%s/unpin', $id), []),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#edit
     * @param string $id
     * @param array $params
     * @return Status
     */
    public function update(string $id, array $params = []): Model|Status
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->put(sprintf('v1/statuses/%s', $id), $params),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#history
     * @param string $id
     * @return StatusEdit[]
     */
    public function history(string $id): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/statuses/%s/history', $id), []),
            new StatusEdit()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/statuses/#source
     * @param string $id
     * @return StatusSource
     */
    public function source(string $id): Model|StatusSource
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/statuses/%s/source', $id), []),
            new StatusSource()
        );
    }
}
