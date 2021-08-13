<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Capsula;

class CapsulasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Capsula::create(['quantidade' => 30]);
        Capsula::create(['quantidade' => 60]);
        Capsula::create(['quantidade' => 90]);
        Capsula::create(['quantidade' => 120]);
    }
}
