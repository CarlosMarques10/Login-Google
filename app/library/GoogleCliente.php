<?php
namespace app\library;

use Google\Client;
use Google\Service\Oauth2\UserInfo;
use Google\Service\Oauth2 as ServiceOauth2;
use GuzzleHttp\Client as GuzzleClient;

class GoogleCliente{

    public readonly Client $client;
    private UserInfo $data;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function init(){
        $guzzleClient = new GuzzleClient(['curl' => [CURLOPT_SSL_VERIFYPEER => FALSE]]);
        $this->client->setHttpClient($guzzleClient);
        $this->client->setAuthConfig('credentials.json');
        $this->client->setRedirectUri('http://localhost/google/public');
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function generateAuthLink(){
        return $this->client->createAuthUrl();
    }

    public function authorized(){
        if(isset($_GET['code'])){
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->client->setAccessToken($token['access_token']);
            $googleService = new ServiceOauth2($this->client);
            $this->data = $googleService->userinfo->get();
            return true;
        }
        return false;
    }

    public function getData(){
        return $this->data;
    }

}