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
                'title' => 'user_management_access',
                'description' => 'Acceso a la gestión de usuarios',
            ],
            [
                'title' => 'permission_create',
                'description' => 'Creación de permisos',
            ],
            [
                'title' => 'permission_edit',
                'description' => 'Edición de permisos',
            ],
            [
                'title' => 'permission_show',
                'description' => 'Mostrar permisos',
            ],
            [
                'title' => 'permission_delete',
                'description' => 'Eliminar permisos',
            ],
            [
                'title' => 'permission_access',
                'description' => 'Acceso a permisos',
            ],
            [
                'title' => 'role_create',
                'description' => 'Creación de roles',
            ],
            [
                'title' => 'role_edit',
                'description' => 'Edición de roles',
            ],
            [
                'title' => 'role_show',
                'description' => 'Mostrar roles',
            ],
            [
                'title' => 'role_delete',
                'description' => 'Eliminar roles',
            ],
            [
                'title' => 'role_access',
                'description' => 'Acceso a roles',
            ],
            [
                'title' => 'user_create',
                'description' => 'Creación de usuarios',
            ],
            [
                'title' => 'user_edit',
                'description' => 'Edición de usuarios',
            ],
            [
                'title' => 'user_show',
                'description' => 'Mostrar usuarios',
            ],
            [
                'title' => 'user_delete',
                'description' => 'Eliminar usuarios',
            ],
            [
                'title' => 'user_access',
                'description' => 'Acceso a usuarios',
            ],
            [
                'title' => 'player_create',
                'description' => 'Creación de jugadores',
            ],
            [
                'title' => 'player_edit',
                'description' => 'Edición de jugadores',
            ],
            [
                'title' => 'player_show',
                'description' => 'Mostrar jugadores',
            ],
            [
                'title' => 'player_delete',
                'description' => 'Eliminar jugadores',
            ],
            [
                'title' => 'player_access',
                'description' => 'Acceso a jugadores',
            ],
            [
                'title' => 'club_create',
                'description' => 'Creación de clubes',
            ],
            [
                'title' => 'club_edit',
                'description' => 'Edición de clubes',
            ],
            [
                'title' => 'club_show',
                'description' => 'Mostrar clubes',
            ],
            [
                'title' => 'club_delete',
                'description' => 'Eliminar clubes',
            ],
            [
                'title' => 'club_access',
                'description' => 'Acceso a clubes',
            ],
            [
                'title' => 'category_create',
                'description' => 'Creación de categorías',
            ],
            [
                'title' => 'category_edit',
                'description' => 'Edición de categorías',
            ],
            [
                'title' => 'category_show',
                'description' => 'Mostrar categorías',
            ],
            [
                'title' => 'category_delete',
                'description' => 'Eliminar categorías',
            ],
            [
                'title' => 'category_access',
                'description' => 'Acceso a categorías',
            ],
            [
                'title' => 'championship_create',
                'description' => 'Creación de campeonatos',
            ],
            [
                'title' => 'championship_edit',
                'description' => 'Edición de campeonatos',
            ],
            [
                'title' => 'championship_show',
                'description' => 'Mostrar campeonatos',
            ],
            [
                'title' => 'championship_delete',
                'description' => 'Eliminar campeonatos',
            ],
            [
                'title' => 'championship_access',
                'description' => 'Acceso a campeonatos',
            ],
            [
                'title' => 'enrollment_create',
                'description' => 'Creación de inscripciones',
            ],
            [
                'title' => 'enrollment_edit',
                'description' => 'Edición de inscripciones',
            ],
            [
                'title' => 'enrollment_show',
                'description' => 'Mostrar inscripciones',
            ],
            [
                'title' => 'enrollment_delete',
                'description' => 'Eliminar inscripciones',
            ],
            [
                'title' => 'enrollment_access',
                'description' => 'Acceso a inscripciones',
            ],
            [
                'title' => 'match_create',
                'description' => 'Creación de partidos',
            ],
            [
                'title' => 'match_edit',
                'description' => 'Edición de partidos',
            ],
            [
                'title' => 'match_show',
                'description' => 'Mostrar partidos',
            ],
            [
                'title' => 'match_delete',
                'description' => 'Eliminar partidos',
            ],
            [
                'title' => 'match_access',
                'description' => 'Acceso a partidos',
            ],
            [
                'title' => 'event_create',
                'description' => 'Creación de eventos',
            ],
            [
                'title' => 'event_edit',
                'description' => 'Edición de eventos',
            ],
            [
                'title' => 'event_show',
                'description' => 'Mostrar eventos',
            ],
            [
                'title' => 'event_delete',
                'description' => 'Eliminar eventos',
            ],
            [
                'title' => 'event_access',
                'description' => 'Acceso a eventos',
            ],
            [
                'title' => 'profile_password_edit',
                'description' => 'Cambiar contraseña de perfil',
            ],
        ];

        Permission::insert($permissions);
    }
}
