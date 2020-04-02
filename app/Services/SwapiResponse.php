<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use stdClass;
use Illuminate\Support\Facades\Http;

class SwapiResponse
{

    /**
     * @var Collection
     */
    private $items;

    /**
     * @var array
     */
    private $response;

    /**
     * @param string $apiUrl
     * @param integer $itemsToFetchCount
     *
     * @return void
     */
    public function __construct(string $apiUrl)
    {
        $this->response = $this->getNewResponse($apiUrl);
        $this->items = $this->getResult();
    }

    /**
     * @return Collection
     */
    public function getItemsCollection(int $itemsToFetchCount)
    {
        $remainingItemsToFetch = $itemsToFetchCount - $this->getItemsCount();

        if ($remainingItemsToFetch > 0) {
            return $this->items;
        }
        return $this->items->take($itemsToFetchCount);
    }


    /**
     * @return int
     */
    public function getItemsCount()
    {
        return $this->items->count();
    }

    /**
     * @return string
     */
    public function getNextPage()
    {
        return $this->response['next'];
    }

    /**
     * @return array
     */
    private function getNewResponse($apiUrl)
    {
        return Http::get($apiUrl)->json();
    }

    /**
     * @return Collection
     */
    private function getResult()
    {
        return collect($this->response['results']);
    }
}
