<?php

namespace App\Services;

use Closure;

class SwapiService
{

    public function getItems(string $apiUrl, int $itemsToFetchCount)
    {
        $collection = collect();

        $collectionGenerator = $this->getItemsCollectionGenerator($apiUrl, $itemsToFetchCount);

        foreach ($collectionGenerator as $result) {
            $collection = $collection->merge($result);
        }

        return $collection;
    }


    private function getItemsCollectionGenerator(string $apiUrl, int $itemsToFetchCount)
    {

        while ($itemsToFetchCount > 0 && $apiUrl !== null) {

            $response = new SwapiResponse($apiUrl);
            yield $response->getItemsCollection($itemsToFetchCount);

            $apiUrl = $response->getNextPage();
            $itemsToFetchCount -= $response->getItemsCount();
        }
    }
}
