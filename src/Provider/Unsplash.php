<?php

namespace Unsplash\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Unsplash extends AbstractProvider
{
    public function getBaseAuthorizationUrl()
    {
        return 'https://unsplash.com/oauth/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://unsplash.com/oauth/token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://api.unsplash.com/me?access_token=' . $token;
    }

    protected function getDefaultScopes()
    {
        return ['public'];
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (! empty($data['error'])) {
            $message = $data['error'].": ".$data['error_description'];
            throw new \Exception($message);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new UnsplashResourceOwner($response);
    }
}