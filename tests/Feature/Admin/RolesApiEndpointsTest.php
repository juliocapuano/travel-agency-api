<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolesApiEndpointsTest extends TestCase
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
    public function canReadRoleList(): void
    {
        Role::factory(25)->create();

        $db_count = Role::count();
        $response = $this->get(route('secure.roles.index'));

        $response->assertOk();
        $response->assertJsonCount($db_count);
        $response->assertJsonIsArray();
    }

    /** @test */
    public function canCreateRole(): void
    {
        $payload = Role::factory()->make();

        $this->assertNull(Role::find($payload->id)); // not in db

        $payload = $payload->only('name');

        $response = $this->post(route('secure.roles.store'), $payload);

        $response->assertCreated();
        $response->assertJsonFragment($payload);
    }

    /** @test */
    public function canReadRole(): void
    {
        $payload = Role::factory()->create();

        $this->assertNotNull(Role::find($payload->id)); // in db

        $response = $this->get(route('secure.roles.show', $payload));

        $response->assertOk();
        $response->assertJsonFragment($payload->toArray());
    }

    /** @test */
    public function canUpdateRole(): void
    {
        $payload = Role::factory()->create();
        $replace = Role::factory()->make();

        $this->assertNotNull(Role::find($payload->id)); // in db
        $this->assertNull(Role::find($replace->id)); // not in db

        $keys = ['name'];

        $modified_payload = $payload->fill($replace->only($keys));

        $response = $this->put(route('secure.roles.update', $payload), $modified_payload->toArray());

        $response->assertAccepted();
        $response->assertJsonFragment($modified_payload->only($keys));
    }

    /** @test */
    public function canDeleteRole(): void
    {
        $payload = Role::factory()->create();

        $this->assertNotNull(Role::find($payload->id)); // in db

        $response = $this->delete(route('secure.roles.destroy', $payload));

        $response->assertNoContent();
    }
}
