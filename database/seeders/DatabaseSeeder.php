<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Championship;
use App\Models\Club;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
        ]);
        $this->make();
    }

    public function make()
    {
        Championship::create([
            'category_id' => Category::create([
                'name' => 'Categoría de prueba',
                'min_age' => 18,
                'max_age' => 65,
            ])->id,
            'name' => 'LigaPro de Prueba',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => '9 de Octubre Fútbol Club',
            'slug' => '9 de Octubre',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Sociedad Deportiva Aucas',
            'slug' => 'Aucas',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Barcelona Sporting Club',
            'slug' => 'Barcelona',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Delfin Sporting Club',
            'slug' => 'Delfin',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Club Deportivo Cuenca',
            'slug' => 'Deportivo Cuenca',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Club Sport Emelec',
            'slug' => 'Emelec',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Guayaquil City Fútbol Club',
            'slug' => 'Guayaquil City',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Club Independiente del Valle',
            'slug' => 'Independiente del Valle',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Liga Deportiva Universitaria de Quito',
            'slug' => 'Liga de Quito',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Club Deportivo Macará',
            'slug' => 'Macará',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Manta Fútbol Club',
            'slug' => 'Manta',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Mushuc Runa Sporting Club',
            'slug' => 'Mushuc Runa',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Centro Deportivo Olmedo',
            'slug' => 'Olmedo',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Orense Sporting Club',
            'slug' => 'Orense',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Club Técnico Universitario',
            'slug' => 'Técnico Universitario',
        ]);
        Club::create([
            'category_id' => 1,
            'name' => 'Club Deportivo Universidad Católica',
            'slug' => 'Universidad Católica',
        ]);

        $clubs = Club::all();
        foreach ($clubs as $club) {

            $players = User::factory()->count(rand(13, 20))->create();

            $enrollment = Enrollment::create([
                'championship_id' => Championship::first()->id,
                'club_id' => $club->id,
            ]);

            $enrollment->players()->attach($players->pluck('id'));
        }
    }
}
