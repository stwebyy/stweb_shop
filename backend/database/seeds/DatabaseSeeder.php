<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                OrderStatusSeeder::class,
                PrefDataSeeder::class,
                RoleDataSeeder::class,
                TagDataSeeder::class,
            ]
        );
    }
}
