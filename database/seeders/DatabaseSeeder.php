<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([CompanySeeder::class]);
        $this->call([UserRolePermissionSeeder::class]);
        $this->call([CompanyuserSeeder::class]);
        $this->call([MenuSeeder::class]);
        $this->call([DictionarySeeder::class]);
        $this->call([DictionaryDataSeeder::class]);
        $this->call([ProjectSeeder::class]);
        $this->call([NotificationruleSeeder::class]);
        $this->call([OptionSeeder::class]);
    }
}
