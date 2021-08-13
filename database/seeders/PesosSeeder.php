<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peso;
class PesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Peso::create(['peso' => '33']);
        Peso::create(['peso' => '150']);
        Peso::create(['peso' => '200']);
        Peso::create(['peso' => '220']);
        Peso::create(['peso' => '500']);
    }
}
