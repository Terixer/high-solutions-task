<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class SwapiService
{
    const SWAPI_API_URL = 'https://swapi.co/api';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // public function getResults($url, $amount)
    // {
    //     $elementsLeft = (int) $amount;
    //     $apiUrl = self::SWAPI_API_URL . $url;
    //     $collection = collect();

    //     while ($elementsLeft > 0) {
    //         $response = $this->getSwapiResponse($apiUrl);
    //         $results = $response->getResults($elementsLeft);
    //         $elementsLeft -= $results->count();
    //         $collection = $collection->merge($results);
    //         $apiUrl = $response->getNextPage();
    //         if ($apiUrl === null) {
    //             break;
    //         }
    //     }

    //     return $collection;
    // }



    public function getResults($url, $amount)
    {
        $collection = collect();

        foreach ($this->getResultGenerator($url, $amount) as $result) {
            $collection = $collection->merge($result);
        }

        return $collection;
    }


    private function getResultGenerator($url, $amount)
    {
        $elementsLeft = (int) $amount;
        $apiUrl = self::SWAPI_API_URL . $url;

        while ($elementsLeft > 0 && $apiUrl !== null) {

            $response = $this->getSwapiResponse($apiUrl);
            $results = $response->getResults($elementsLeft);
            $elementsLeft -= $results->count();
            $apiUrl = $response->getNextPage();

            yield $results;
        }
    }

    private function getSwapiResponse($apiUrl)
    {
        $response = $this->prepareGetResponse($apiUrl);
        $body = $this->getBody($response);
        return $this->prepareResponse($body);
    }

    private function getBody($response)
    {
        return $response->getBody();
    }

    private function prepareGetResponse($url)
    {
        return $this->client->get($url);
    }

    private function prepareResponse($content)
    {
        return new SwapiResponse($content);
    }
}
