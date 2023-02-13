<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminCanonicalEmailBlock;
use Maphpodon\models\Model;

class CanonicalEmailBlocks
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/canonical_email_blocks/#get
     * @param array $params
     * @return AdminCanonicalEmailBlock[]
     */
    public function list(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/canonical_email_blocks', $params),
            new AdminCanonicalEmailBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/canonical_email_blocks/#get-one
     * @param string $id
     * @return AdminCanonicalEmailBlock
     */
    public function view(string $id): Model|AdminCanonicalEmailBlock
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/admin/canonical_email_blocks/%s', $id), []),
            new AdminCanonicalEmailBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/canonical_email_blocks/#test
     * @param array $params
     * @return AdminCanonicalEmailBlock[]
     */
    public function test(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->post('v1/admin/canonical_email_blocks/test', $params),
            new AdminCanonicalEmailBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/canonical_email_blocks/#create
     * @param array $params
     * @return AdminCanonicalEmailBlock
     */
    public function create(array $params = []): Model|AdminCanonicalEmailBlock
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('v1/admin/canonical_email_blocks', $params),
            new AdminCanonicalEmailBlock()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/canonical_email_blocks/#delete
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $this->maphpodon->delete(sprintf('v1/admin/canonical_email_blocks/%s', $id));
    }
}
