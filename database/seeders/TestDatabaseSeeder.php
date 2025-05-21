<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar en tabla Users
        DB::table('Users')->insert([
            [
                'nombre' => 'Admin Uno',
                'apellidos' => 'admin01',
                'telefono' => '111111111',
                'email' => 'admin01@example.com',
                'password' => Hash::make('123456789'),
                'tipo_user' => 'admin',
                'fecha_alta' => Carbon::now(),
                'activo' => true,
            ],
            [

                'nombre' => 'Admin Dos',
                'apellidos' => 'admin02',
                'telefono' => '111111111',
                'email' => 'admin02@example.com',
                'password' => Hash::make('123456789'),
                'tipo_user' => 'admin',
                'fecha_alta' => Carbon::now(),
                'activo' => true,
            ],
            [
                'nombre' => 'Paciente Uno',
                'apellidos' => 'paciente01',
                'telefono' => '111111111',
                'email' => 'paciente01@example.com',
                'password' => Hash::make('123456789'),
                'tipo_user' => 'paciente',
                'fecha_alta' => Carbon::now(),
                'activo' => true,
            ],
            [
                'nombre' => 'Paciente Dos',
                'apellidos' => 'paciente02',
                'telefono' => '112211111',
                'email' => 'paciente02@example.com',
                'password' => Hash::make('123456789'),
                'tipo_user' => 'paciente',
                'fecha_alta' => Carbon::now(),
                'activo' => true,
            ],
            [
                'nombre' => 'Facultativo Uno',
                'apellidos' => 'facultativo01',
                'telefono' => '111111111',
                'email' => 'facultativo01@example.com',
                'password' => Hash::make('123456789'),
                'tipo_user' => 'facultativo',
                'fecha_alta' => Carbon::now(),
                'activo' => true,
            ],
            [

                'nombre' => 'Facultativo Dos',
                'apellidos' => 'facultativo02',
                'telefono' => '112211111',
                'email' => 'facultativo02@example.com',
                'password' => Hash::make('123456789'),
                'tipo_user' => 'facultativo',
                'fecha_alta' => Carbon::now(),
                'activo' => true,
            ],
        ]);

        // Insertar especialidades
        DB::table('Especialidades')->insert([
            [
                'nombre_especialidad' => 'Cardiología',
                'descripcion' => 'Especialidad médica que se ocupa del corazón',
            ],
            [
                'nombre_especialidad' => 'Dermatología',
                'descripcion' => 'Especialidad en la piel y enfermedades cutáneas',
            ],
        ]);

        // Insertar facultativos
        DB::table('Facultativos')->insert([
            [
                'ID_user' => 5, // Facultativo
                'ID_especialidad' => 1,
            ],
            [
                'ID_user' => 6, // Facultativo
                'ID_especialidad' => 2,
            ],
        ]);

        // Insertar autorizaciones
        DB::table('Facultativos_Autorizados')->insert([
            [
                'ID_user' => 3,
                'ID_facultativo' => 1,
                'fecha_alta' => Carbon::now(),
                'activo' => true,
            ],
            [
                'ID_user' => 4,
                'ID_facultativo' => 2,
                'fecha_alta' => Carbon::now(),
                'activo' => true,
            ],
        ]);

        // Insertar enlaces
        DB::table('Enlaces')->insert([
            [
                'ID_user' => 3,
                'nombre_url' => 'Resultados Análisis',
                'ruta_enlace' => 'https://lab.clinica.com/resultados',
                'observacion_url' => 'Enlace a resultados recientes',
                'fecha_alta' => Carbon::now(),
            ],
            [
                'ID_user' => 5,
                'nombre_url' => 'Protocolo Médico',
                'ruta_enlace' => 'https://clinica.com/protocolo',
                'observacion_url' => 'Guía para nuevo tratamiento',
                'fecha_alta' => Carbon::now(),
            ],
        ]);

        // Insertar documentos
        DB::table('Documentos')->insert([
            [
                'ID_user' => 3,
                'nombre_documento' => 'Revisión inicial sin anomalías.',
                'ruta_documento' => '/store/nota_archivo',
                'fecha_alta' => Carbon::now(),
            ],
            [
                'ID_user' => 2,
                'nombre_documento' => 'Síntomas de dolor leve en el pecho.',
                'ruta_documento' => '/store/nota_archivo',
                'fecha_alta' => Carbon::now(),
            ],
        ]);
    }
}
