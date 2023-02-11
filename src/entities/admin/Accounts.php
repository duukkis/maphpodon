<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminAccount;
use Maphpodon\models\Model;

class Accounts
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#v1
     * @param array $params
     * @return AdminAccount[]
     */
    public function viewV1(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/accounts', $params),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#v2
     * @param array $params
     * @return AdminAccount[]
     */
    public function viewV2(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v2/admin/accounts', $params),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#get-one
     * @param string $id
     * @return AdminAccount
     */
    public function view(string $id): Model|AdminAccount
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/admin/accounts/%s', $id), []),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#approve
     * @param string $id
     * @return AdminAccount
     */
    public function approve(string $id): Model|AdminAccount
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/accounts/%s/approve', $id), []),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#reject
     * @param string $id
     * @return AdminAccount
     */
    public function reject(string $id): Model|AdminAccount
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/accounts/%s/reject', $id), []),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#delete
     * @param string $id
     * @return AdminAccount
     */
    public function delete(string $id): Model|AdminAccount
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->delete(sprintf('v1/admin/accounts/%s', $id)),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#action
     * @param string $id
     * @param array $params
     * @return void
     */
    public function action(string $id, array $params): void
    {
        $this->maphpodon->post(sprintf('v1/admin/accounts/%s/action', $id), $params);
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#enable
     * @param string $id
     * @return AdminAccount
     */
    public function enable(string $id): Model|AdminAccount
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/accounts/%s/reject', $id), []),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#unsilence
     * @param string $id
     * @return AdminAccount
     */
    public function unsilence(string $id): Model|AdminAccount
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/accounts/%s/unsilence', $id), []),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#unsuspend
     * @param string $id
     * @return AdminAccount
     */
    public function unsuspend(string $id): Model|AdminAccount
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/accounts/%s/unsuspend', $id), []),
            new AdminAccount()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/accounts/#unsensitive
     * @param string $id
     * @return AdminAccount
     */
    public function unsensitive(string $id): Model|AdminAccount
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post(sprintf('v1/admin/accounts/%s/unsensitive', $id), []),
            new AdminAccount()
        );
    }
}
