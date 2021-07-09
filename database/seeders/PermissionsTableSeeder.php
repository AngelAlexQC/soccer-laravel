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
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'club_create',
            ],
            [
                'id'    => 18,
                'title' => 'club_edit',
            ],
            [
                'id'    => 19,
                'title' => 'club_show',
            ],
            [
                'id'    => 20,
                'title' => 'club_delete',
            ],
            [
                'id'    => 21,
                'title' => 'club_access',
            ],
            [
                'id'    => 22,
                'title' => 'category_create',
            ],
            [
                'id'    => 23,
                'title' => 'category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'category_show',
            ],
            [
                'id'    => 25,
                'title' => 'category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'category_access',
            ],
            [
                'id'    => 27,
                'title' => 'championship_create',
            ],
            [
                'id'    => 28,
                'title' => 'championship_edit',
            ],
            [
                'id'    => 29,
                'title' => 'championship_show',
            ],
            [
                'id'    => 30,
                'title' => 'championship_delete',
            ],
            [
                'id'    => 31,
                'title' => 'championship_access',
            ],
            [
                'id'    => 32,
                'title' => 'enrollment_create',
            ],
            [
                'id'    => 33,
                'title' => 'enrollment_edit',
            ],
            [
                'id'    => 34,
                'title' => 'enrollment_show',
            ],
            [
                'id'    => 35,
                'title' => 'enrollment_delete',
            ],
            [
                'id'    => 36,
                'title' => 'enrollment_access',
            ],
            [
                'id'    => 37,
                'title' => 'match_create',
            ],
            [
                'id'    => 38,
                'title' => 'match_edit',
            ],
            [
                'id'    => 39,
                'title' => 'match_show',
            ],
            [
                'id'    => 40,
                'title' => 'match_delete',
            ],
            [
                'id'    => 41,
                'title' => 'match_access',
            ],
            [
                'id'    => 42,
                'title' => 'event_create',
            ],
            [
                'id'    => 43,
                'title' => 'event_edit',
            ],
            [
                'id'    => 44,
                'title' => 'event_show',
            ],
            [
                'id'    => 45,
                'title' => 'event_delete',
            ],
            [
                'id'    => 46,
                'title' => 'event_access',
            ],
            [
                'id'    => 47,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
