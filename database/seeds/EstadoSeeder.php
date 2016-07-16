<?php

use Illuminate\Database\Seeder;
use App\Estado;
class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create(['estado'=>'Bolívar']);
        Estado::create(['estado'=>'Monagas']);
        Estado::create(['estado'=>'Carabobo']);
        
    }
}
