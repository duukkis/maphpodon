<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminDomainBlock;
use Maphpodon\models\Model;

class DomainBlocks
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_blocks/#get
     * @param array $params
     * @return AdminDomainBlock[]
     */
    public function list(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/domain_blocks', $params),
            new AdminDomainBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_blocks/#get-one
     * @param string $id
     * @return AdminDomainBlock
     */
    public function view(string $id): Model|AdminDomainBlock
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/admin/domain_blocks/%s', $id), []),
            new AdminDomainBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_blocks/#create
     * @param array $params
     * @return AdminDomainBlock
     */
    public function create(array $params = []): Model|AdminDomainBlock
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('v1/admin/domain_blocks', $params),
            new AdminDomainBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_blocks/#update
     * @param string $id
     * @param array $params
     * @return AdminDomainBlock
     */
    public function update(string $id, array $params = []): Model|AdminDomainBlock
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->put(sprintf('v1/admin/domain_blocks/%s', $id), $params),
            new AdminDomainBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_blocks/#delete
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $this->maphpodon->delete(sprintf('v1/admin/domain_blocks/%s', $id));
    }
}
