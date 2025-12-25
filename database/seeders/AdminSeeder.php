<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Make one temporary admin, to always be there at creation of the site.
     */
    public function run(): void
    {

        DB::table("users")->insert([
            'id' => 420,
            'name' => "test",
            'email' => "test@example.com",
            'birthday' => "1969-4-20",
            'about_me' => "I'm a user made for testing!",
            'password' => Hash::make('qazwsxedc')
        ]);

        DB::table("users")->insert([
            'id' => 42,
            'name' => "admin",
            'email' => "admin@example.com",
            'birthday' => "2004-04-06",
            'about_me' => "I'm the big boss admin! My name is Steven Bertsonn",
            'password' => Hash::make('qazwsxedc')
        ]);

        DB::table("admin")->insert([
            "user_id" => 42
        ]);
    }
}
