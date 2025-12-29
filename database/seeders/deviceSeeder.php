<?php

namespace Database\Seeders;

use App\Models\Device;
use Carbon\Carbon;
use Date;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class deviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Device::updateOrCreate([
            'name' => "Commodore 64",
            'release_date' =>  Carbon::create('1982', '08', '01'),
            'description' => "I'm running out of time, admin can change this"
        ]);
        Device::updateOrCreate([
            'name' => "Nintendo Entertainment System",
            'release_date' =>  Carbon::create('1985', '10', '18'),
            'description' => "I'm running out of time, admin can change this"
        ]);
        Device::updateOrCreate([
            'name' => "Terminator",
            'release_date' =>  Carbon::create('1984', '10', '26'),
            'description' => "Not technology, but a fun movie!"
        ]);
    }
}
