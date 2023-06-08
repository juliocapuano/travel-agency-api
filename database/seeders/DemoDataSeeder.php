<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Tour;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()
            ->each(function (User $user) {
                $roles = random_int(0, 10) >= 7
                    ? Role::all()
                    : Role::whereName('editor')->get();
                $user->roles()->sync($roles);
            });

        Travel::factory(10)->create()
            ->each(function (Travel $travel) {
                Tour::factory(random_int(2, 6))->create([
                    'travel_id' => $travel->id,
                ]);
            });
    }
}
