<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {

      //  $this->call(ProvinciasSeeder::class);
      // $this->call(PuestosSeeder::class);
      //  $this->call(TiposSeeder::class);
      //$this->call(CantonesSeeder::class);
      //  $this->call(DistritosSeeder::class);
        $this->call(OrganizacionesSeeder::class);
        // User::factory(1)->create();

    /*  User::factory()->create([
            'name' => 'Cristofer',
            'email' => 'crisangulo123@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    */
    }
}
