<?php

namespace Looxis\Gate;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class GateProvider extends AbstractProvider implements ProviderInterface
{
    private $token;

    public function getUrl($path = null, $params = null)
    {
        $url = config('gate.url');

        if ($path) {
            $url .= '/' . ltrim($path, '/');
        }

        if ($params) {
            $url .= '?' . http_build_query($params);
        }

        return $url;
    }

    public function enabled()
    {
        return config('gate.enabled', false);
    }

    public function getLogoutUrl()
    {
        return $this->getUrl("/logout", ['redirect' => \URL::to('/')]);
    }

    public function logout()
    {
        $this->getHttpClient()
            ->post(
                $this->getLogoutUrl(),
                $this->getRequestOptions()
            );
    }

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(config('gate.authorize_url'), $state);
    }

    public function getTokenUrl()
    {
        return config('gate.token_url');
    }

    protected function getUserByToken($token)
    {
        $this->token = $token;
        $userUrl = config('gate.user_url');

        $response = $this->getHttpClient()->get(
            $userUrl,
            $this->getRequestOptions()
        );

        $user = json_decode($response->getBody(), true);

        return $user;
    }

    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'       => $user['id'],
            //'nickname' => $user['username'],
            'name'     => $user['name'],
            'email'    => $user['email'],
            //'avatar'   => $user['avatar'],
        ]);
    }

    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code'
        ]);
    }
    protected function getRequestOptions()
    {
        return [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ];
    }
}
