<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table(User::getTable())->truncate();
        DB::table(Config::getTable())->truncate();

        User::factory()->create([
            'email' => 'admin@mailinator.com',
        ]);

        $this->call(ConfigSeeder::class);
    }
}
