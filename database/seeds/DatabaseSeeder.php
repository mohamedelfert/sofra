<?php

use Database\Seeders\CreateAdminUserSeeder;
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
//        $this->call(CreateAdminUserSeeder::class);
        $this->call(\Database\Seeders\CreateAdminUserSeeder::class);
        $this->call(\Database\Seeders\PermissionTableSeeder::class);
    }
}
