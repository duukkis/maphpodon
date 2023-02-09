<?php

namespace Maphpodon\entities;

use Maphpodon\helpers\Mapper;
use Maphpodon\Maphpodon;
use Maphpodon\models\Model;
use Maphpodon\models\Token;

class Auth
{
    public function __construct(protected Maphpodon $maphpodon)
    {
    }

    /**
     * @return string
     */
    public function authorize(
        string $scope = "read",
        string $redirectUrl = "urn:ietf:wg:oauth:2.0:oob",
        string $forceLogin = "true",
        string $lang = "en"
    ): string
    {
        return 'https://' . $this->maphpodon->getDomain() . '/oauth/authorize' .
            '?response_type=code' .
            '&client_id=' . $this->maphpodon->clientKey .
            '&redirect_uri=' . $redirectUrl .
            '&scope=' . $scope .
            '&force_login=' . $forceLogin .
            '&lang=' . $lang;
    }

    public function token(array $params): Model|Token
    {
        $params = ["json" => $params];
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('oauth/token', $params),
            new Token()
        );
    }
}
