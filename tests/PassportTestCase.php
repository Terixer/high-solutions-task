<?php

namespace Tests;

use App\Models\User;
use App\User as AppUser;
use Laravel\Passport\ClientRepository;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PassportTestCase extends TestCase
{

    use RefreshDatabase;

    protected $headers = [];
    protected $scopes = [];
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            '/'
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
        ]);

        $this->user = factory(AppUser::class)->create([
            'email' => 'admin@admin.com'
        ]);

        $token = $this->user->createToken('TestToken', $this->scopes)->accessToken;
        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer ' . $token;

        $this->actingAs($this->user);
    }


    public function getJsonWithAuth($uri, array $headers = [])
    {
        return parent::getJson($uri, array_merge($this->headers, $headers));
    }

    public function postJsonWithAuth($uri, array $data = [], array $headers = [])
    {
        return parent::postJson($uri, $data, array_merge($this->headers, $headers));
    }
}
