<?php

use Illuminate\Database\Seeder;
use App\Sector;
class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::create(['sector'=>'Villa Alianza','estado_id'=>1,'ciudad_id'=>1]);
        Sector::create(['sector'=>'La Cruz','estado_id'=>2,'ciudad_id'=>2]);
    }
}
