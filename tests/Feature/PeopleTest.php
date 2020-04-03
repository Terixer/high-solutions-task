<?php

namespace Tests\Feature;

use App\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\PassportTestCase;

class PeopleTest extends PassportTestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_if_user_can_see_list_of_people()
    {
        factory(Person::class)->create();

        $person = Person::all()->random();

        $response = $this->getJsonWithAuth(route('people.index'));
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'height',
                        'mass',
                        'hair_color',
                        'skin_color',
                        'eye_color',
                        'birth_year',
                        'gender',
                        'url'
                    ]
                ],
            ])
            ->assertJsonFragment([
                'id' => $person->id,
                'name' => $person->name
            ]);
    }

    /** @test */
    public function check_if_user_can_see_single_person()
    {
        factory(Person::class)->create();

        $person = Person::all()->random();

        $response = $this->getJsonWithAuth(route('people.show', [
            'person' => $person->name
        ]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'height',
                    'mass',
                    'hair_color',
                    'skin_color',
                    'eye_color',
                    'birth_year',
                    'gender',
                    'url'
                ],
            ])
            ->assertJsonFragment([
                'id' => $person->id,
                'name' => $person->name
            ]);
    }
}
