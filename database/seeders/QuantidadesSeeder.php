<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quantidade;
class QuantidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quantidade::create(['quantidade' => '30']);
        Quantidade::create(['quantidade' => '220']);
        Quantidade::create(['quantidade' => '420']);
        Quantidade::create(['quantidade' => '500']);
    }
}
