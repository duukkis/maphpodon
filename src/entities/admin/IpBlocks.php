<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminIpBlock;
use Maphpodon\models\Model;

class IpBlocks
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/ip_blocks/#get
     * @param array $params
     * @return AdminIpBlock[]
     */
    public function list(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/ip_blocks', $params),
            new AdminIpBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/ip_blocks/#get-one
     * @param string $id
     * @return AdminIpBlock
     */
    public function view(string $id): Model|AdminIpBlock
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/admin/ip_blocks/%s', $id), []),
            new AdminIpBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/ip_blocks/#create
     * @param array $params
     * @return AdminIpBlock
     */
    public function create(array $params = []): Model|AdminIpBlock
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('v1/admin/ip_blocks', $params),
            new AdminIpBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/ip_blocks/#update
     * @param string $id
     * @param array $params
     * @return AdminIpBlock
     */
    public function update(string $id, array $params = []): Model|AdminIpBlock
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->put(sprintf('v1/admin/ip_blocks/%s', $id), $params),
            new AdminIpBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/ip_blocks/#delete
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $this->maphpodon->delete(sprintf('v1/admin/ip_blocks/%s', $id));
    }
}
