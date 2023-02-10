<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\Account;
use Maphpodon\models\FeatureTag;
use Maphpodon\models\MList;
use Maphpodon\models\Model;
use Maphpodon\models\Relationship;
use Maphpodon\models\Status;

class Accounts
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#get
     * @param string $id
     * @return Account
     */
    public function get(string $id): Model|Account
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/accounts/%s', $id), []),
            new Account()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#statuses
     * @param string $id
     * @param array $params
     * @return Status[]
     */
    public function statuses(string $id, array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/accounts/%s/statuses', $id), ["query" => $params]),
            new Status()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#followers
     * @param string $id
     * @param array $params
     * @return Account[]
     */
    public function followers(string $id, array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/accounts/%s/followers', $id), ["query" => $params]),
            new Account()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#following
     * @param string $id
     * @param array $params
     * @return Account[]
     */
    public function following(string $id, array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/accounts/%s/following', $id), ["query" => $params]),
            new Account()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#featured_tags
     * @param string $id
     * @param array $params
     * @return FeatureTag[]
     */
    public function featured_tags(string $id, array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/accounts/%s/featured_tags', $id), ["query" => $params]),
            new FeatureTag()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#lists
     * @param string $id
     * @param array $params
     * @return MList[]
     */
    public function lists(string $id, array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/accounts/%s/lists', $id), ["query" => $params]),
            new MList()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#follow
     * @param string $id
     * @param array $params
     * @return Relationship
     */
    public function follow(string $id, array $params = []): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/follow', $id), ["json" => $params]),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#unfollow
     * @param string $id
     * @return Relationship
     */
    public function unfollow(string $id): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/unfollow', $id)),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#remove_from_followers
     * @param string $id
     * @return Relationship
     */
    public function remove_from_followers(string $id): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/remove_from_followers', $id)),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#block
     * @param string $id
     * @return Relationship
     */
    public function block(string $id): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/block', $id)),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#unblock
     * @param string $id
     * @return Relationship
     */
    public function unblock(string $id): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/unblock', $id)),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#mute
     * @param string $id
     * @param array $params
     * @return Relationship
     */
    public function mute(string $id, ?array $params = []): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/mute', $id), ["json" => $params]),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#unmute
     * @param string $id
     * @return Relationship
     */
    public function unmute(string $id): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/unmute', $id)),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#pin
     * @param string $id
     * @return Relationship
     */
    public function pin(string $id): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/pin', $id)),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#unpin
     * @param string $id
     * @return Relationship
     */
    public function unpin(string $id): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/unpin', $id)),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#note
     * @param string $id
     * @return Relationship
     */
    public function note(string $id, ?array $params = []): Model|Relationship
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/accounts/%s/note', $id), ["json" => $params]),
            new Relationship()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#relationships
     * @param array $params
     * @return Relationship[]
     */
    public function relationships(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/accounts/relationships', ["query" => $params]),
            new Relationship()
        );
    }
}
