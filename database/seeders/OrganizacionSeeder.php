<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizacion;
use App\Models\Provincia;
use App\Models\Canton;
use App\Models\Distrito;
use App\Models\TipoOrganizacion;
use App\Models\User;

class OrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener tipos de organizaciones
        $tipoGobiernoLocal = TipoOrganizacion::where('nombre', 'Gobierno Local')->first();
        $tipoInstitucionPublica = TipoOrganizacion::where('nombre', 'Institucion Pública')->first();
        $tipoCooperativa = TipoOrganizacion::where('nombre', 'Cooperativa')->first();
        $tipoConsorcio = TipoOrganizacion::where('nombre', 'Consorcio')->first();
        $tipoONG = TipoOrganizacion::where('nombre', 'ONG')->first();
        
        $user = User::where('role', 'admin')->first();

        // Crear organizaciones de prueba con coordenadas correctas y diferentes categorías
        $organizaciones = [
            // MUNICIPALIDADES / GOBIERNO LOCAL
            [
                'ced_juridica' => 3101223456,
                'nombre' => 'Municipalidad de San José',
                'tipo_id' => $tipoGobiernoLocal->id ?? 1,
                'telefono' => '2547-8000',
                'correo' => 'info@msj.go.cr',
                'urlPageWeb' => 'https://www.msj.go.cr',
                'provincia_id' => 1, // San José
                'canton_id' => 101, // San José
                'distrito_id' => 10101, // Carmen
                'ubi_Lat' => '9.933333',
                'ubi_long' => '-84.083333',
                'urlDirectorioTelefonico' => 'https://www.msj.go.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3101567890,
                'nombre' => 'Municipalidad de Santa Cruz',
                'tipo_id' => $tipoGobiernoLocal->id ?? 1,
                'telefono' => '2680-0600',
                'correo' => 'info@santacruz.go.cr',
                'urlPageWeb' => 'https://www.santacruz.go.cr',
                'provincia_id' => 5, // Guanacaste
                'canton_id' => 503, // Santa Cruz
                'distrito_id' => 50301, // Santa Cruz
                'ubi_Lat' => '10.251667',
                'ubi_long' => '-85.685278',
                'urlDirectorioTelefonico' => 'https://www.santacruz.go.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3101234567,
                'nombre' => 'Municipalidad de Cartago',
                'tipo_id' => $tipoGobiernoLocal->id ?? 1,
                'telefono' => '2591-1500',
                'correo' => 'info@municartago.go.cr',
                'urlPageWeb' => 'https://www.municartago.go.cr',
                'provincia_id' => 3, // Cartago
                'canton_id' => 301, // Cartago
                'distrito_id' => 30101, // Oriental
                'ubi_Lat' => '9.862500',
                'ubi_long' => '-83.919444',
                'urlDirectorioTelefonico' => 'https://www.municartago.go.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3101345678,
                'nombre' => 'Municipalidad de Heredia',
                'tipo_id' => $tipoGobiernoLocal->id ?? 1,
                'telefono' => '2277-6000',
                'correo' => 'info@muniheredia.go.cr',
                'urlPageWeb' => 'https://www.muniheredia.go.cr',
                'provincia_id' => 4, // Heredia
                'canton_id' => 401, // Heredia
                'distrito_id' => 40101, // Heredia
                'ubi_Lat' => '9.998611',
                'ubi_long' => '-84.116944',
                'urlDirectorioTelefonico' => 'https://www.muniheredia.go.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],

            // INSTITUCIONES PÚBLICAS
            [
                'ced_juridica' => 3101274567,
                'nombre' => 'Ministerio de Educación Pública',
                'tipo_id' => $tipoInstitucionPublica->id ?? 2,
                'telefono' => '2547-9000',
                'correo' => 'info@mep.go.cr',
                'urlPageWeb' => 'https://www.mep.go.cr',
                'provincia_id' => 1, // San José
                'canton_id' => 101, // San José
                'distrito_id' => 10105, // Zapote
                'ubi_Lat' => '9.935556',
                'ubi_long' => '-84.084444',
                'urlDirectorioTelefonico' => 'https://www.mep.go.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 310135678,
                'nombre' => 'Caja Costarricense de Seguro Social',
                'tipo_id' => $tipoInstitucionPublica->id ?? 2,
                'telefono' => '2547-2000',
                'correo' => 'consultas@ccss.sa.cr',
                'urlPageWeb' => 'https://www.ccss.sa.cr',
                'provincia_id' => 1, // San José
                'canton_id' => 101, // San José
                'distrito_id' => 10101, // Carmen
                'ubi_Lat' => '9.937778',
                'ubi_long' => '-84.081111',
                'urlDirectorioTelefonico' => 'https://www.ccss.sa.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3101456789,
                'nombre' => 'Instituto Costarricense de Electricidad',
                'tipo_id' => $tipoInstitucionPublica->id ?? 2,
                'telefono' => '2547-3000',
                'correo' => 'info@ice.go.cr',
                'urlPageWeb' => 'https://www.ice.go.cr',
                'provincia_id' => 1, // San José
                'canton_id' => 101, // San José
                'distrito_id' => 10101, // Carmen
                'ubi_Lat' => '9.940000',
                'ubi_long' => '-84.082222',
                'urlDirectorioTelefonico' => 'https://www.ice.go.cr/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3101678901,
                'nombre' => 'Instituto Nacional de Seguros',
                'tipo_id' => $tipoInstitucionPublica->id ?? 2,
                'telefono' => '2287-6000',
                'correo' => 'info@ins-cr.com',
                'urlPageWeb' => 'https://www.ins-cr.com',
                'provincia_id' => 1, // San José
                'canton_id' => 101, // San José
                'distrito_id' => 10101, // Carmen
                'ubi_Lat' => '9.932222',
                'ubi_long' => '-84.087778',
                'urlDirectorioTelefonico' => 'https://www.ins-cr.com/directorio',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3101789012,
                'nombre' => 'Banco Nacional de Costa Rica',
                'tipo_id' => $tipoInstitucionPublica->id ?? 2,
                'telefono' => '2212-2000',
                'correo' => 'info@bncr.fi.cr',
                'urlPageWeb' => 'https://www.bncr.fi.cr',
                'provincia_id' => 1, // San José
                'canton_id' => 101, // San José
                'distrito_id' => 10104, // Catedral
                'ubi_Lat' => '9.934167',
                'ubi_long' => '-84.076944',
                'urlDirectorioTelefonico' => 'https://www.bncr.fi.cr/contacto',
                'user_id' => $user->id ?? 1,
            ],

            // COOPERATIVAS
            [
                'ced_juridica' => 3004012345,
                'nombre' => 'Cooperativa de Productores de Leche Dos Pinos',
                'tipo_id' => $tipoCooperativa->id ?? 3,
                'telefono' => '2437-6000',
                'correo' => 'info@dospinos.com',
                'urlPageWeb' => 'https://www.dospinos.com',
                'provincia_id' => 2, // Alajuela
                'canton_id' => 201, // Alajuela
                'distrito_id' => 20101, // Alajuela
                'ubi_Lat' => '10.007778',
                'ubi_long' => '-84.254444',
                'urlDirectorioTelefonico' => 'https://www.dospinos.com/contacto',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3004023456,
                'nombre' => 'Cooperativa de Caficultores de Dota',
                'tipo_id' => $tipoCooperativa->id ?? 3,
                'telefono' => '2541-2828',
                'correo' => 'info@coopedota.com',
                'urlPageWeb' => 'https://www.coopedota.com',
                'provincia_id' => 1, // San José
                'canton_id' => 117, // Dota
                'distrito_id' => 11701, // Santa María
                'ubi_Lat' => '9.546389',
                'ubi_long' => '-83.955278',
                'urlDirectorioTelefonico' => 'https://www.coopedota.com/contacto',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3004034567,
                'nombre' => 'Cooperativa de Electrificación Rural de San Carlos',
                'tipo_id' => $tipoCooperativa->id ?? 3,
                'telefono' => '2460-0000',
                'correo' => 'info@coopelesca.co.cr',
                'urlPageWeb' => 'https://www.coopelesca.co.cr',
                'provincia_id' => 2, // Alajuela
                'canton_id' => 210, // San Carlos
                'distrito_id' => 21001, // Quesada
                'ubi_Lat' => '10.477222',
                'ubi_long' => '-84.433056',
                'urlDirectorioTelefonico' => 'https://www.coopelesca.co.cr/contacto',
                'user_id' => $user->id ?? 1,
            ],

            // CONSORCIOS
            [
                'ced_juridica' => 3102012345,
                'nombre' => 'Consorcio Nacional de Empresas de Telecomunicaciones',
                'tipo_id' => $tipoConsorcio->id ?? 4,
                'telefono' => '2256-7890',
                'correo' => 'info@conet.cr',
                'urlPageWeb' => 'https://www.conet.cr',
                'provincia_id' => 1, // San José
                'canton_id' => 101, // San José
                'distrito_id' => 10109, // Pavas
                'ubi_Lat' => '9.928611',
                'ubi_long' => '-84.141667',
                'urlDirectorioTelefonico' => 'https://www.conet.cr/contacto',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3102023456,
                'nombre' => 'Consorcio de Desarrollo Agrícola del Atlántico',
                'tipo_id' => $tipoConsorcio->id ?? 4,
                'telefono' => '2798-1234',
                'correo' => 'info@codaa.cr',
                'urlPageWeb' => 'https://www.codaa.cr',
                'provincia_id' => 7, // Limón
                'canton_id' => 702, // Pococí
                'distrito_id' => 70201, // Guápiles
                'ubi_Lat' => '10.195833',
                'ubi_long' => '-83.793056',
                'urlDirectorioTelefonico' => 'https://www.codaa.cr/contacto',
                'user_id' => $user->id ?? 1,
            ],

            // ONGs
            [
                'ced_juridica' => 3006012345,
                'nombre' => 'Fundación para el Desarrollo Sostenible',
                'tipo_id' => $tipoONG->id ?? 5,
                'telefono' => '2234-5678',
                'correo' => 'info@fundecos.org',
                'urlPageWeb' => 'https://www.fundecos.org',
                'provincia_id' => 1, // San José
                'canton_id' => 101, // San José
                'distrito_id' => 10101, // Carmen
                'ubi_Lat' => '9.927500',
                'ubi_long' => '-84.073333',
                'urlDirectorioTelefonico' => 'https://www.fundecos.org/contacto',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3006023456,
                'nombre' => 'ONG Amigos de la Naturaleza',
                'tipo_id' => $tipoONG->id ?? 5,
                'telefono' => '2645-5678',
                'correo' => 'info@amigosnat.org',
                'urlPageWeb' => 'https://www.amigosnat.org',
                'provincia_id' => 6, // Puntarenas
                'canton_id' => 606, // Quepos
                'distrito_id' => 60601, // Quepos
                'ubi_Lat' => '9.614722',
                'ubi_long' => '-84.162778',
                'urlDirectorioTelefonico' => 'https://www.amigosnat.org/contacto',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3006034567,
                'nombre' => 'Asociación Pro Bienestar Infantil',
                'tipo_id' => $tipoONG->id ?? 5,
                'telefono' => '2256-9012',
                'correo' => 'info@probienestar.org',
                'urlPageWeb' => 'https://www.probienestar.org',
                'provincia_id' => 3, // Cartago
                'canton_id' => 303, // La Unión
                'distrito_id' => 30301, // Tres Ríos
                'ubi_Lat' => '9.865833',
                'ubi_long' => '-83.994167',
                'urlDirectorioTelefonico' => 'https://www.probienestar.org/contacto',
                'user_id' => $user->id ?? 1,
            ],
            [
                'ced_juridica' => 3006045678,
                'nombre' => 'Centro de Conservación Marina del Pacífico',
                'tipo_id' => $tipoONG->id ?? 5,
                'telefono' => '2653-9876',
                'correo' => 'info@ccmpacifico.org',
                'urlPageWeb' => 'https://www.ccmpacifico.org',
                'provincia_id' => 6, // Puntarenas
                'canton_id' => 611, // Garabito
                'distrito_id' => 61101, // Jacó
                'ubi_Lat' => '9.979444',
                'ubi_long' => '-84.628611',
                'urlDirectorioTelefonico' => 'https://www.ccmpacifico.org/contacto',
                'user_id' => $user->id ?? 1,
            ],
        ];

        foreach ($organizaciones as $org) {
            Organizacion::create($org);
        }

        $this->command->info('✓ ' . count($organizaciones) . ' organizaciones de prueba creadas exitosamente.');
    }
}
