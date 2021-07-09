<?php

namespace Database\Seeders;

use App\Models\Championship;
use App\Models\Club;
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

    function make()
    {
        Championship::create([
            'name' => 'LigaPro de Prueba',
            'detalle' => 'Campeonato para probar las funcionalidades del sistema',
            'min_age' => 18,
            'max_age' => 50
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => '9 de Octubre Fútbol Club',
            'slug' => '9 de Octubre',
            'picture' => 'https://omo.akamai.opta.net/image.php?secure=true&h=omo.akamai.opta.net&sport=football&entity=team&description=badges&dimensions=150&id=5522'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Sociedad Deportiva Aucas',
            'slug' => 'Aucas',
            'picture' => 'https://3.bp.blogspot.com/-pIfu59B2FAw/WjjGnnv5wkI/AAAAAAABQgU/nYHloIY_qWEYREJiigRfb9q9XTTTBr5nwCLcBGAs/s1600/Sociedad%2BDeportiva%2BAucas.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Barcelona Sporting Club',
            'slug' => 'Barcelona',
            'picture' => 'https://logodownload.org/wp-content/uploads/2020/02/barcelona-guayaquil-logo-1.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Delfin Sporting Club',
            'slug' => 'Delfin',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/e/e0/Delfin_SC_Logo.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Club Deportivo Cuenca',
            'slug' => 'Deportivo Cuenca',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Football_of_Ecuador_-_Deportivo_Cuenca_EC_icon.svg/1200px-Football_of_Ecuador_-_Deportivo_Cuenca_EC_icon.svg.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Club Sport Emelec',
            'slug' => 'Emelec',
            'picture' => 'https://logodownload.org/wp-content/uploads/2018/04/emelec-logo-escudo-1.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Guayaquil City Fútbol Club',
            'slug' => 'Guayaquil City',
            'picture' => 'http://ww-content/uploads/2017/07/Logo.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Club Independiente del Valle',
            'slug' => 'Independiente del Valle',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/0/06/Independiente_del_Valle_Logo_2020.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Liga Deportiva Universitaria de Quito',
            'slug' => 'Liga de Quito',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/e/e8/LDUQuitologo2.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Club Deportivo Macará',
            'slug' => 'Macará',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/5/57/Macara_6.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Manta Fútbol Club',
            'slug' => 'Manta',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/b/bd/ESCUDO_LOGO_MANTA_FC.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Mushuc Runa Sporting Club',
            'slug' => 'Mushuc Runa',
            'picture' => 'https://a2.espncdn.com/combiner/i?img=%2Fi%2Fteamlogos%2Fsoccer%2F500%2F17176.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Centro Deportivo Olmedo',
            'slug' => 'Olmedo',
            'picture' => 'https://clubdeportivogloria.com/wp-content/uploads/2019/04/olmedo-1.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Orense Sporting Club',
            'slug' => 'Orense',
            'picture' => 'https://lh3.googleusercontent.com/proxy/yEvUs1EgeLEfqlcl2mWX57yltfQjnSSau8VbubZOTjpwbk2MoABySpPO8v4g4dHJR785MbTsDR_mUxSJq5xQEx_X5yXla8e_ylUMDRPSlnudHwZJKtPk1uw1JO2T1FO7Ic-UORleE5M'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Club Técnico Universitario',
            'slug' => 'Técnico Universitario',
            'picture' => 'https://upload.wikimedia.org/wikipedia/commons/9/9c/T%C3%A9cnico_Universitario_Identificador.png'
        ]);
        Club::create([
            'championship_id' => 1,
            'name' => 'Club Deportivo Universidad Católica',
            'slug' => 'Universidad Católica',
            'picture' => 'http://as00.epimg.net/img/comunes/fotos/fichas/equipos/large/4284.png'
        ]);
    }
}
