<?php

namespace App\Console\Commands\Swapi;

use App\Services\SwapiService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

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

        $this->info("Fetching $count people from SWAPI...");

        $bar = $this->output->createProgressBar(2);

        $bar->start();

        $peopleCollection = $swapiService->getItems(self::SWAPI_PEOPLE_URL, $count);
        $bar->advance();


        $bar->finish();
    }
}
