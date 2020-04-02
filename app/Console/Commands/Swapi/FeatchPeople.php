<?php

namespace App\Console\Commands\Swapi;

use App\Person;
use App\Services\SwapiService;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class FetchPeople extends Command
{
    const SWAPI_PEOPLE_URL = 'https://swapi.co/api/people/';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:fetch:people {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch {count} people from SWAPI';

    /**
     * @var int
     */
    private $peopleCollectionCount;

    /**
     * @var SwapiService
     */
    private $swapiService;

    /**
     * @var Collection
     */
    private $peopleCollection;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(SwapiService $swapiService)
    {
        $this->swapiService = $swapiService;

        $count = $this->getArgument('count');

        $this->info("START SWAPI!");

        $this->clearPeopleTable();

        $this->fetchElements($count);

        $this->clearCollection();

        $this->insertCollectionToDatabase();

        $this->info("Fetch and add to database $this->peopleCollectionCount!");
    }

    private function getArgument($key)
    {
        return $this->argument($key);
    }

    private function clearPeopleTable()
    {
        Person::truncate();

        $this->info("Truncate People models");
    }

    private function fetchElements($count)
    {
        $this->peopleCollection = $this->swapiService->getItems(self::SWAPI_PEOPLE_URL, $count);

        $this->peopleCollectionCount = $this->peopleCollection->count();
        if ($this->peopleCollectionCount < $count) {
            $this->warn("Fetch only $this->peopleCollectionCount / $count, because there are no more.");
        }

        $this->info("Fetch $this->peopleCollectionCount people!");
    }

    private function clearCollection()
    {
        $this->peopleCollection = $this->peopleCollection->transform(function ($collection) {
            return collect($collection)->only(Person::ATTRIBUTES_TO_FETCH);
        });

        $this->info("Remove unnecessary attributes from collection.");
    }

    private function insertCollectionToDatabase()
    {
        Person::insert($this->peopleCollection->toArray());

        $this->info("Insert $this->peopleCollectionCount people to database.");
    }
}
