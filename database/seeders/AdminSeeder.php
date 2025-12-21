<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Make one temporary admin, to always be there at creation of the site.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            'id' => 42,
            'name' => "admin",
            'email' => "admin@example.com",
            'password' => Hash::make('qazwsxedc')
        ]);

        DB::table("admin")->insert([
            "user_id" => 42
        ]);
    }
}
