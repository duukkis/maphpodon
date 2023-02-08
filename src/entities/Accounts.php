<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\Account;

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
    public function get(string $id): Account
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/accounts/%s', $id), []),
            new Account()
        );
    }
}
