<?php

namespace Zubair\Fetchr;

use GuzzleHttp\Client;
use Zubair\Fetchr\Exceptions\FetchrApiException;
use Config;
use GuzzleHttp\Exception\ClientException;

class Fetchr
{
    protected $accessToken;
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->accessToken = Config::get('fetchr.token');
    }

    public function __call($method , $args)
    {
        return $this->makeRequest($args[0]);
    }

    private function endpoint()
    {
        return "https://api.fetchr.us/v3/orders/dropship";
    }

    private function getRequestHeaders()
    {
        $requestHeaders = [
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->accessToken
        ];

        return $requestHeaders;
    }

    private function makeRequest($requestBody)
    {
        try{
            $response = $this->client->request('POST' , $this->endpoint() , [
                'headers' => $this->getRequestHeaders(),
                'json' => $requestBody
            ]);
            $responseBody =  json_decode($response->getBody() , true);
            return $responseBody;
        }catch(ClientException $e){
            throw new FetchrApiException(
                $e->getMessage() , $e->getCode()
            );
        }
    }
}