<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $organizaciones = [
            [
                'ced_juridica' => 3014042063,
                'nombre' => 'Municipalidad de Alajuela',
                'tipo_id' => 1,
                'telefono' => '24362300',
                'correo' => 'munialajuela.redsocial@munialajuela.go.cr',
                'urlPageWeb' => 'https://www.munialajuela.go.cr/',
                'provincia_id' => 2, // Alajuela
                'canton_id' => null,
                'distrito_id' => null,
                'ubi_Lat' => 10.0171412,
                'ubi_long' => -84.210448,
                'urlDirectorioTelefonico' => 'https://www.munialajuela.go.cr/contactenos',
                'user_id' => null,
            ],
            [
                'ced_juridica' => 3014042065,
                'nombre' => 'Municipalidad de Atenas',
                'tipo_id' => 1,
                'telefono' => '24465040',
                'correo' => 'comunicacion@atenasmuni.go.cr',
                'urlPageWeb' => 'https://www.atenasmuni.go.cr/',
                'provincia_id' => 2,
                'canton_id' => null,
                'distrito_id' => null,
                'ubi_Lat' => 9.9788536,
                'ubi_long' => -84.3804325,
                'urlDirectorioTelefonico' => 'https://www.atenasmuni.go.cr/directorio-municipal',
                'user_id' => null,
            ],
            [
                'ced_juridica' => 301404206412,
                'nombre' => 'Municipalidad de Grecia',
                'tipo_id' => 1,
                'telefono' => '24956200',
                'correo' => 'alcaldia@grecia.go.cr',
                'urlPageWeb' => 'https://www.grecia.go.cr/',
                'provincia_id' => 2,
                'canton_id' => null,
                'distrito_id' => null,
                'ubi_Lat' => 10.0732811,
                'ubi_long' => -84.3120192,
                'urlDirectorioTelefonico' => 'https://www.grecia.go.cr/contactos',
                'user_id' => null,
            ],
            [
                'ced_juridica' => 3014042067,
                'nombre' => 'Municipalidad de Guatuso',
                'tipo_id' => 1,
                'telefono' => '24640065',
                'correo' => 'alcaldia@muniguatuso.go.cr',
                'urlPageWeb' => 'https://muniguatuso.go.cr/',
                'provincia_id' => 2,
                'canton_id' => null,
                'distrito_id' => null,
                'ubi_Lat' => 10.6698207,
                'ubi_long' => -84.8216561,
                'urlDirectorioTelefonico' => 'https://muniguatuso.go.cr/index.php/centro-de-informacion/directorio-telefonico-guatuso.html',
                'user_id' => null,
            ],
            [
                'ced_juridica' => 3014042068,
                'nombre' => 'Municipalidad de Los Chiles',
                'tipo_id' => 1,
                'telefono' => '24711038',
                'correo' => 'infotramites@muniloschiles.go.cr',
                'urlPageWeb' => 'https://www.muniloschiles.go.cr/',
                'provincia_id' => 2,
                'canton_id' => null,
                'distrito_id' => null,
                'ubi_Lat' => 11.030695,
                'ubi_long' => -84.7174696,
                'urlDirectorioTelefonico' => 'https://www.muniloschiles.go.cr/index.php/mn-conozcanos/mn-mimunicipalidad/mn-directoriotelefonico',
                'user_id' => null,
            ],
            [
                'ced_juridica' => 3014042069,
                'nombre' => 'Municipalidad de Naranjo',
                'tipo_id' => 1,
                'telefono' => '24515858',
                'correo' => 'informacion@naranjo.go.cr',
                'urlPageWeb' => 'https://www.naranjo.go.cr/',
                'provincia_id' => 2,
                'canton_id' => null,
                'distrito_id' => null,
                'ubi_Lat' => 10.0973049,
                'ubi_long' => -84.3782054,
                'urlDirectorioTelefonico' => 'https://www.naranjo.go.cr/directorio/',
                'user_id' => null,
            ],
            [
                'ced_juridica' => 3014042070,
                'nombre' => 'Municipalidad de Orotina',
                'tipo_id' => 1,
                'telefono' => '24288047',
                'correo' => 'kperaza@muniorotina.go.cr',
                'urlPageWeb' => 'https://muniorotina.go.cr/',
                'provincia_id' => 2,
                'canton_id' => null,
                'distrito_id' => null,
                'ubi_Lat' => 9.9111528,
                'ubi_long' => -84.5239723,
                'urlDirectorioTelefonico' => 'https://muniorotina.go.cr/index.php/ayuda/directorio-telefonico',
                'user_id' => null,
            ],
            [
                'ced_juridica' => 3014042071,
                'nombre' => 'Municipalidad de Palmares',
                'tipo_id' => 1,
                'telefono' => '24539600',
                'correo' => 'info@munipalmares.go.cr',
                'urlPageWeb' => 'https://www.munipalmares.go.cr/index.php',
                'provincia_id' => 2,
                'canton_id' => null,
                'distrito_id' => null,
                'ubi_Lat' => 10.0561865,
                'ubi_long' => -84.4334127,
                'urlDirectorioTelefonico' => 'https://www.munipalmares.go.cr/index.php/contactenos/comuniquese',
                'user_id' => null,
            ],
        ];
        \App\Models\Organizacion::insert($organizaciones);
    }
}
