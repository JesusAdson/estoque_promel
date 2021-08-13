<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create(['descricao' => 'Gelatinoso']);
        Tipo::create(['descricao' => 'Cápsula em pó']);
        Tipo::create(['descricao' => 'Comprimido']);
        Tipo::create(['descricao' => 'Pesagem']);
        Tipo::create(['descricao' => 'Mel']);
    }
}
