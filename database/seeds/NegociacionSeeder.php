<?php

use Illuminate\Database\Seeder;
use App\Negociacion;
class NegociacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Negociacion::create(['negociacion'=>'Venta']);
        Negociacion::create(['negociacion'=>'Alquiler']);
    }
}
