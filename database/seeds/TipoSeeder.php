<?php

use Illuminate\Database\Seeder;
use App\Tipo;
class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create(['tipo'=>'Casa']);
        Tipo::create(['tipo'=>'Apartamento']);
        Tipo::create(['tipo'=>'Quinta']);
        
    }
}
