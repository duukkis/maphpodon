<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\instances\MediaAttachment;
use Maphpodon\Maphpodon;

class Media
{
    public function __construct(protected Maphpodon $maphpodon)
    {

    }

    public function post(string $absoluteFilePath, ?string $absoluteThumbnailPath, array $params = []): MediaAttachment
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

    public function get(string $id): MediaAttachment
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/media/%s', $id), []),
            new MediaAttachment()
        );
    }
}