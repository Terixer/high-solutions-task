<?php

namespace App\Services;

use Illuminate\Support\Collection;

class SwapiResponse
{

    /**
     * @var string
     */
    private $nextPage;

    /**
     * @var string
     */
    private $previousPage;

    /**
     * @var Collection
     */
    private $results;

    /**
     * @var array
     */
    private $response;

    public function __construct($content)
    {
        $this->response = json_decode($content);
        $this->nextPage = $this->response->next;
        $this->previousPage = $this->response->previous;
        $this->results = collect($this->response->results);
    }

    public function getResults($leftAmount)
    {
        $amount = $leftAmount - $this->results->count();
        if ($amount > 0) {
            return $this->results;
        }
        return $this->results->take($leftAmount);
    }

    public function getNextPage()
    {
        return $this->nextPage;
    }
}
