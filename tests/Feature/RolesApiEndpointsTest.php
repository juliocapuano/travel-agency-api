<?php

namespace Tests\Feature;

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
    }

    /** @test */
    public function canReadRoleList(): void
    {
        Role::factory(25)->create();

        $db_count = Role::count();
        $response = $this->get(route('roles.index'));

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

        $response = $this->post(route('roles.store'), $payload);

        $response->assertCreated();
        $response->assertJsonFragment($payload);
    }

    /** @test */
    public function canReadRole(): void
    {
        $payload = Role::factory()->create();

        $this->assertNotNull(Role::find($payload->id)); // in db

        $response = $this->get(route('roles.show', $payload));

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

        $response = $this->put(route('roles.update', $payload), $modified_payload->toArray());

        $response->assertAccepted();
        $response->assertJsonFragment($modified_payload->only($keys));
    }

    /** @test */
    public function canDeleteRole(): void
    {
        $payload = Role::factory()->create();

        $this->assertNotNull(Role::find($payload->id)); // in db

        $response = $this->delete(route('roles.destroy', $payload));

        $response->assertNoContent();
    }
}
