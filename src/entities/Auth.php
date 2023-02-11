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
     * @link https://docs.joinmastodon.org/methods/oauth/#authorize
     * @param string $scope
     * @param string $redirectUrl
     * @param string $forceLogin
     * @param string $lang
     * @return string
     */
    public function authorize(
        string $scope = "read",
        string $redirectUrl = "urn:ietf:wg:oauth:2.0:oob",
        string $forceLogin = "true",
        string $lang = "en"
    ): string {
        return 'https://' . $this->maphpodon->getDomain() . '/oauth/authorize' .
            '?response_type=code' .
            '&client_id=' . $this->maphpodon->clientKey .
            '&redirect_uri=' . $redirectUrl .
            '&scope=' . $scope .
            '&force_login=' . $forceLogin .
            '&lang=' . $lang;
    }

    /**
     * @link https://docs.joinmastodon.org/methods/oauth/#token
     * @param array $params
     * @return Model|Token
     */
    public function token(array $params): Model|Token
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->post('/oauth/token', $params),
            new Token()
        );
    }

    /**
     * @link https://docs.joinmastodon.org/methods/oauth/#revoke
     * @param array $params
     * @return void
     */
    public function revoke(array $params): void
    {
        $this->maphpodon->post('/oauth/revoke', $params);
    }
}
