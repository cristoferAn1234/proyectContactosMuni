<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contacto;
use App\Models\Organizacion;
use App\Models\Puesto;
use App\Models\User;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener datos necesarios para las relaciones
        $organizacion = Organizacion::first();
        $puesto = Puesto::first();
        $user = User::where('role', 'admin')->first();

        // Crear 4 contactos de prueba
        $contactos = [
            [
                'nombre' => 'Juan',
                'apellido1' => 'Pérez',
                'apellido2' => 'Rodríguez',
                'sexo' => 'Masculino',
                'puesto' => 'Director General',
                'puesto_id' => $puesto->id ?? 1,
                'departamento' => 'Dirección',
                'formacion' => 'Licenciatura en Administración Pública',
                'extension' => '1001',
                'email_institucional' => 'jperez@organizacion.go.cr',
                'organizacion_id' => $organizacion->id ?? 1,
                'activo' => 1,
                'nivel_contacto' => 'Alto',
                'created_by' => $user->id ?? 1,
                'updated_by' => $user->id ?? 1,
            ],
            [
                'nombre' => 'María',
                'apellido1' => 'González',
                'apellido2' => 'Mora',
                'sexo' => 'Femenino',
                'puesto' => 'Jefa de Recursos Humanos',
                'puesto_id' => $puesto->id ?? 1,
                'departamento' => 'Recursos Humanos',
                'formacion' => 'Licenciatura en Psicología',
                'extension' => '1002',
                'email_institucional' => 'mgonzalez@organizacion.go.cr',
                'organizacion_id' => $organizacion->id ?? 1,
                'activo' => 1,
                'nivel_contacto' => 'Alto',
                'created_by' => $user->id ?? 1,
                'updated_by' => $user->id ?? 1,
            ],
            [
                'nombre' => 'Carlos',
                'apellido1' => 'Ramírez',
                'apellido2' => 'Castro',
                'sexo' => 'Masculino',
                'puesto' => 'Coordinador de TI',
                'puesto_id' => $puesto->id ?? 1,
                'departamento' => 'Tecnología de Información',
                'formacion' => 'Ingeniería en Sistemas',
                'extension' => '1003',
                'email_institucional' => 'cramirez@organizacion.go.cr',
                'organizacion_id' => $organizacion->id ?? 1,
                'activo' => 1,
                'nivel_contacto' => 'Medio',
                'created_by' => $user->id ?? 1,
                'updated_by' => $user->id ?? 1,
            ],
            [
                'nombre' => 'Ana',
                'apellido1' => 'Fernández',
                'apellido2' => 'Solís',
                'sexo' => 'Femenino',
                'puesto' => 'Asistente Administrativa',
                'puesto_id' => $puesto->id ?? 1,
                'departamento' => 'Administración',
                'formacion' => 'Bachillerato en Secretariado',
                'extension' => '1004',
                'email_institucional' => 'afernandez@organizacion.go.cr',
                'organizacion_id' => $organizacion->id ?? 1,
                'activo' => 1,
                'nivel_contacto' => 'Bajo',
                'created_by' => $user->id ?? 1,
                'updated_by' => $user->id ?? 1,
            ],
        ];

        foreach ($contactos as $contacto) {
            Contacto::create($contacto);
        }

        $this->command->info('✓ 4 contactos de prueba creados exitosamente.');
    }
}
