<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
                'description' => 'Acceso a la gestión de usuarios',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
                'description' => 'Creación de permisos',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
                'description' => 'Edición de permisos',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
                'description' => 'Mostrar permisos',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
                'description' => 'Eliminar permisos',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
                'description' => 'Acceso a permisos',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
                'description' => 'Creación de roles',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
                'description' => 'Edición de roles',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
                'description' => 'Mostrar roles',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
                'description' => 'Eliminar roles',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
                'description' => 'Acceso a roles',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
                'description' => 'Creación de usuarios',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
                'description' => 'Edición de usuarios',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
                'description' => 'Mostrar usuarios',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
                'description' => 'Eliminar usuarios',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
                'description' => 'Acceso a usuarios',
            ],
            [
                'id'    => 17,
                'title' => 'club_create',
                'description' => 'Creación de clubes',
            ],
            [
                'id'    => 18,
                'title' => 'club_edit',
                'description' => 'Edición de clubes',
            ],
            [
                'id'    => 19,
                'title' => 'club_show',
                'description' => 'Mostrar clubes',
            ],
            [
                'id'    => 20,
                'title' => 'club_delete',
                'description' => 'Eliminar clubes',
            ],
            [
                'id'    => 21,
                'title' => 'club_access',
                'description' => 'Acceso a clubes',
            ],
            [
                'id'    => 22,
                'title' => 'category_create',
                'description' => 'Creación de categorías',
            ],
            [
                'id'    => 23,
                'title' => 'category_edit',
                'description' => 'Edición de categorías',
            ],
            [
                'id'    => 24,
                'title' => 'category_show',
                'description' => 'Mostrar categorías',
            ],
            [
                'id'    => 25,
                'title' => 'category_delete',
                'description' => 'Eliminar categorías',
            ],
            [
                'id'    => 26,
                'title' => 'category_access',
                'description' => 'Acceso a categorías',
            ],
            [
                'id'    => 27,
                'title' => 'championship_create',
                'description' => 'Creación de campeonatos',
            ],
            [
                'id'    => 28,
                'title' => 'championship_edit',
                'description' => 'Edición de campeonatos',
            ],
            [
                'id'    => 29,
                'title' => 'championship_show',
                'description' => 'Mostrar campeonatos',
            ],
            [
                'id'    => 30,
                'title' => 'championship_delete',
                'description' => 'Eliminar campeonatos',
            ],
            [
                'id'    => 31,
                'title' => 'championship_access',
                'description' => 'Acceso a campeonatos',
            ],
            [
                'id'    => 32,
                'title' => 'enrollment_create',
                'description' => 'Creación de inscripciones',
            ],
            [
                'id'    => 33,
                'title' => 'enrollment_edit',
                'description' => 'Edición de inscripciones',
            ],
            [
                'id'    => 34,
                'title' => 'enrollment_show',
                'description' => 'Mostrar inscripciones',
            ],
            [
                'id'    => 35,
                'title' => 'enrollment_delete',
                'description' => 'Eliminar inscripciones',
            ],
            [
                'id'    => 36,
                'title' => 'enrollment_access',
                'description' => 'Acceso a inscripciones',
            ],
            [
                'id'    => 37,
                'title' => 'match_create',
                'description' => 'Creación de partidos',
            ],
            [
                'id'    => 38,
                'title' => 'match_edit',
                'description' => 'Edición de partidos',
            ],
            [
                'id'    => 39,
                'title' => 'match_show',
                'description' => 'Mostrar partidos',
            ],
            [
                'id'    => 40,
                'title' => 'match_delete',
                'description' => 'Eliminar partidos',
            ],
            [
                'id'    => 41,
                'title' => 'match_access',
                'description' => 'Acceso a partidos',
            ],
            [
                'id'    => 42,
                'title' => 'event_create',
                'description' => 'Creación de eventos',
            ],
            [
                'id'    => 43,
                'title' => 'event_edit',
                'description' => 'Edición de eventos',
            ],
            [
                'id'    => 44,
                'title' => 'event_show',
                'description' => 'Mostrar eventos',
            ],
            [
                'id'    => 45,
                'title' => 'event_delete',
                'description' => 'Eliminar eventos',
            ],
            [
                'id'    => 46,
                'title' => 'event_access',
                'description' => 'Acceso a eventos',
            ],
            [
                'id'    => 47,
                'title' => 'profile_password_edit',
                'description' => 'Cambiar contraseña de perfil',
            ],
        ];

        Permission::insert($permissions);
    }
}
