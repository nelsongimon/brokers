<?php

use Illuminate\Database\Seeder;
use App\Ciudad;
class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudad::create(['ciudad'=>'Pto Ordaz','estado_id'=>1]);
        Ciudad::create(['ciudad'=>'Maturín','estado_id'=>2]);
    }
}
