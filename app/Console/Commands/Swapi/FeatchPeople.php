<?php

namespace App\Console\Commands\Swapi;

use Illuminate\Console\Command;

class FetchPeople extends Command
{
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
    public function handle()
    {
        $amount = $this->argument('amount');

        $this->info("Featching $amount people from SWAPI...");

        $bar = $this->output->createProgressBar($amount);

        $bar->start();

        $bar->advance();

        $bar->finish();
    }
}
