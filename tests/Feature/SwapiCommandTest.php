<?php

namespace Tests\Feature;

use App\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SwapiCommandTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function it_can_fetch_and_create_people()
    {
        $count = 14;
        $this->artisan('swapi:fetch:people ' . $count)
            ->expectsOutput('Truncate People models')
            ->expectsOutput("Fetching $count people....")
            ->expectsOutput('Remove unnecessary attributes from collection.')
            ->expectsOutput("Insert $count people to database.")
            ->expectsOutput("Fetch and add to database $count!")
            ->assertExitCode(0);

        $this->assertEquals(Person::all()->count(), $count);
    }

    /** @test */
    public function it_can_fetch_and_create_people_if_provide_to_many()
    {
        $peopleInSwapi = (int) Http::get('https://swapi.co/api/people/')->json()['count'];
        $count = $peopleInSwapi + 10;

        $this->artisan('swapi:fetch:people ' . $count)
            ->expectsOutput('Truncate People models')
            ->expectsOutput("Fetching $count people....")
            ->expectsOutput("Fetch only $peopleInSwapi / $count, because there are no more.")
            ->expectsOutput('Remove unnecessary attributes from collection.')
            ->expectsOutput("Insert $peopleInSwapi people to database.")
            ->expectsOutput("Fetch and add to database $peopleInSwapi!")
            ->assertExitCode(0);

        $this->assertTrue($peopleInSwapi < $count);
        $this->assertEquals(Person::all()->count(), $peopleInSwapi);
    }
}
