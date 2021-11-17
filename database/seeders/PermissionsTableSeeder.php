<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {


        $permissionsSpanish = [
            [
                'id'    => 1,
                'title' => 'Acceso a la gestión de usuarios',
            ],
            [
                'id'    => 2,
                'title' => 'creación de permisos',
            ],
            [
                'id'    => 3,
                'title' => 'edición de permisos',
            ],
            [
                'id'    => 4,
                'title' => 'visualización de permisos',
            ],
            [
                'id'    => 5,
                'title' => 'eliminación de permisos',
            ],
            [
                'id'    => 6,
                'title' => 'acceso a permisos',
            ],
            [
                'id'    => 7,
                'title' => 'creación de roles',
            ],
            [
                'id'    => 8,
                'title' => 'edición de roles',
            ],
            [
                'id'    => 9,
                'title' => 'visualización de roles',
            ],
            [
                'id'    => 10,
                'title' => 'eliminación de roles',
            ],
            [
                'id'    => 11,
                'title' => 'acceso a roles',
            ],
            [
                'id'    => 12,
                'title' => 'creación de usuarios',
            ],
            [
                'id'    => 13,
                'title' => 'edición de usuarios',
            ],
            [
                'id'    => 14,
                'title' => 'visualización de usuarios',
            ],
            [
                'id'    => 15,
                'title' => 'eliminación de usuarios',
            ],
            [
                'id'    => 16,
                'title' => 'acceso a usuarios',
            ],
            [
                'id'    => 17,
                'title' => 'creación de clubes',
            ],
            [
                'id'    => 18,
                'title' => 'edición de clubes',
            ],
            [
                'id'    => 19,
                'title' => 'visualización de clubes',
            ],
            [
                'id'    => 20,
                'title' => 'eliminación de clubes',
            ],
            [
                'id'    => 21,
                'title' => 'acceso a clubes',
            ],
            [
                'id'    => 22,
                'title' => 'creación de categorías',
            ],
            [
                'id'    => 23,
                'title' => 'edición de categorías',
            ],
            [
                'id'    => 24,
                'title' => 'visualización de categorías',
            ],
            [
                'id'    => 25,
                'title' => 'eliminación de categorías',
            ],
            [
                'id'    => 26,
                'title' => 'acceso a categorías',
            ],
            [
                'id'    => 27,
                'title' => 'creación de campeonatos',
            ],
            [
                'id'    => 28,
                'title' => 'edición de campeonatos',
            ],
            [
                'id'    => 29,
                'title' => 'visualización de campeonatos',
            ],
            [
                'id'    => 30,
                'title' => 'eliminación de campeonatos',
            ],
            [
                'id'    => 31,
                'title' => 'acceso a campeonatos',
            ],
            [
                'id'    => 32,
                'title' => 'creación de inscripciones',
            ],
            [
                'id'    => 33,
                'title' => 'edición de inscripciones',
            ],
            [
                'id'    => 34,
                'title' => 'visualización de inscripciones',
            ],
            [
                'id'    => 35,
                'title' => 'eliminación de inscripciones',
            ],
            [
                'id'    => 36,
                'title' => 'acceso a inscripciones',
            ],
            [
                'id'    => 37,
                'title' => 'creación de partidos',
            ],
            [
                'id'    => 38,
                'title' => 'edición de partidos',
            ],
            [
                'id'    => 39,
                'title' => 'visualización de partidos',
            ],
            [
                'id'    => 40,
                'title' => 'eliminación de partidos',
            ],
            [
                'id'    => 41,
                'title' => 'acceso a partidos',
            ],
            [
                'id'    => 42,
                'title' => 'creación de eventos',
            ],
            [
                'id'    => 43,
                'title' => 'edición de eventos',
            ],
            [
                'id'    => 44,
                'title' => 'visualización de eventos',
            ],
            [
                'id'    => 45,
                'title' => 'eliminación de eventos',
            ],
            [
                'id'    => 46,
                'title' => 'acceso a eventos',
            ],
            [
                'id'    => 47,
                'title' => 'edición de contraseña de perfil',
            ],

        ];

        Permission::insert($permissionsSpanish);
    }
}
