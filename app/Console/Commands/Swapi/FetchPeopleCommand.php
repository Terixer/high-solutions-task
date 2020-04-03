<?php

namespace App\Console\Commands\Swapi;

use App\Person;
use App\Services\SwapiService;
use Illuminate\Console\Command;

class FetchPeopleCommand extends Command
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
        $count = $this->argument('count');

        $this->info("START SWAPI!");

        $this->info("Truncate People models");
        Person::truncate();

        $this->info("Fetching $peopleCount people!");
        $peopleCollection = $swapiService->getItems(self::SWAPI_PEOPLE_URL, $count);
        $peopleCount = $peopleCollection->count();
        if ($peopleCollection->count() < $count) {
            $this->warn("Fetch only $peopleCount / $count, because there are no more.");
        }


        $this->info("Remove unnecessary attributes from collection.");
        $peopleCollection = $peopleCollection->transform(function ($collection) {
            return collect($collection)->only(Person::ATTRIBUTES_TO_FETCH);
        });

        $this->info("Insert $peopleCount people to database.");
        Person::insert($peopleCollection->toArray());


        $this->info("Fetch and add to database $peopleCount!");
    }
}
