<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        (new DatabaseSeeder())->run(); // run seeder

        $token = \App\Models\User::first()->createToken(get_class($this))->plainTextToken;
        $this->withToken($token);
    }

    /** @test */
    public function canReadUserList(): void
    {
        User::factory(25)->create();

        $db_count = User::count();
        $response = $this->get(route('secure.users.index'));

        $response->assertOk();
        $response->assertJsonCount($db_count);
        $response->assertJsonIsArray();
    }

    /** @test */
    public function canCreateUser(): void
    {
        $payload = User::factory()->make();

        $this->assertNull(User::find($payload->id)); // not in db

        $payload = $payload->only('name', 'email');

        $response = $this->post(route('secure.users.store'), [
            ...$payload,
            'password' => Str::random(12) . '@',
            'roles'    => ['admin'],
        ]);

        $response->assertCreated();
        $response->assertJsonFragment($payload);
    }

    /** @test */
    public function canReadUser(): void
    {
        $payload = User::factory()->create();

        $this->assertNotNull(User::find($payload->id)); // in db

        $response = $this->get(route('secure.users.show', $payload));

        $response->assertOk();
        $response->assertJsonFragment($payload->toArray());
    }

    /** @test */
    public function canUpdateUser(): void
    {
        $payload = User::factory()->create();
        $replace = User::factory()->make();

        $this->assertNotNull(User::find($payload->id)); // in db
        $this->assertNull(User::find($replace->id)); // not in db

        $keys = ['name', 'email'];

        $modified_payload = $payload->fill($replace->only($keys));

        $response = $this->put(route('secure.users.update', $payload), $modified_payload->toArray());

        $response->assertAccepted();
        $response->assertJsonFragment($modified_payload->only($keys));
    }

    /** @test */
    public function canDeleteUser(): void
    {
        $payload = User::factory()->create();

        $this->assertNotNull(User::find($payload->id)); // in db

        $response = $this->delete(route('secure.users.destroy', $payload));

        $response->assertNoContent();
    }
}
