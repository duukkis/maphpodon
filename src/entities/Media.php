<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\models\MediaAttachment;
use Maphpodon\Maphpodon;
use Maphpodon\models\Model;

class Media
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    public function post(string $absoluteFilePath, ?string $absoluteThumbnailPath, array $params = []): Model|MediaAttachment
    {
        /**
         *  these need ot go in somehow
        $params = Mapper::cleanParams(
            $params,
            ["description", "focus"]
        );
        */
        $params['multipart'] = [
            [
                'name'     => 'file',
                'contents' => fopen($absoluteFilePath, 'r')
            ]
        ];
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->upload('v2/media', $params),
            new MediaAttachment()
        );
    }

    public function get(string $id): Model|MediaAttachment
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/media/%s', $id), []),
            new MediaAttachment()
        );
    }
}
