<?php

namespace Maphpodon\entities\admin;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\admin\AdminDomainAllow;
use Maphpodon\models\Model;

class DomainAllows
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_allows/#get
     * @param array $params
     * @return AdminDomainAllow[]
     */
    public function list(array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get('v1/admin/domain_allows', $params),
            new AdminDomainAllow()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_allows/#get-one
     * @param string $id
     * @return AdminDomainAllow
     */
    public function view(string $id): Model|AdminDomainAllow
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/admin/domain_allows/%s', $id), []),
            new AdminDomainAllow()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_allows/#create
     * @param array $params
     * @return AdminDomainAllow
     */
    public function create(array $params = []): Model|AdminDomainAllow
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('v1/admin/domain_allows', $params),
            new AdminDomainAllow()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/admin/domain_allows/#delete
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $this->maphpodon->delete(sprintf('v1/admin/domain_allows/%s', $id));
    }
}
