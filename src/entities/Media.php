<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\MediaAttachment;
use Maphpodon\models\Model;

class Media
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @link https://docs.joinmastodon.org/methods/media/#v2
     * @param string $absoluteFilePath
     * @param string|null $description
     * @param string|null $focus
     * @return Model|MediaAttachment
     */
    public function post(
        string $absoluteFilePath,
        ?string $description = null,
        ?string $focus = null
    ): Model|MediaAttachment {
        $newparams = [];
        $newparams['multipart'] = [
            [
                'name'     => 'file',
                'contents' => fopen($absoluteFilePath, 'r')
            ]
        ];
        if ($description !== null) {
            $newparams['multipart'][] = [
                'name'     => 'description',
                'contents' => $description
            ];
        }
        if ($focus !== null) {
            $newparams['multipart'][] = [
                'name'     => 'focus',
                'contents' => $focus
            ];
        }
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->upload('v2/media', $newparams),
            new MediaAttachment()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/media/#get
     * @param string $id
     * @return Model|MediaAttachment
     */
    public function get(string $id): Model|MediaAttachment
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/media/%s', $id), []),
            new MediaAttachment()
        );
    }
}
