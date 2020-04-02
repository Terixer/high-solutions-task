<?php

namespace App\Console\Commands\Swapi;

use App\Services\SwapiService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchPeople extends Command
{
    const SWAPI_PEOPLE_URL = '/people/';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:fetch:people {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch {amount} people from SWAPI';

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
        $amount = $this->argument('amount');

        $this->info("Featching $amount people from SWAPI...");

        dd($swapiService->getResults(self::SWAPI_PEOPLE_URL, $amount));

        $bar = $this->output->createProgressBar($amount);

        $bar->start();

        $bar->advance();

        $bar->finish();
    }
}
