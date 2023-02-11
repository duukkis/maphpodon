<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminAccount;

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
     * @return array
     */
    public function view(string $id): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/admin/accounts/%s', $id), []),
            new AdminAccount()
        );
    }
}
