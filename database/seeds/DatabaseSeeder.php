<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(TipoSeeder::class);
        $this->call(NegociacionSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(SectorSeeder::class);
        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
