<?php

namespace Database\Seeders;

use App\Models\Usuarios;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new Usuarios();
        $u->username = "admin";
        $u->password = "$2y$12$4KyJPKKQFP46tvZ/LIBMnulWOYovGSdfI4duQ4MVRdkEs/zz1yjeq";
        $u->nombre = "Soy";
        $u->ape_paterno = "Un";
        $u->ape_materno = "Administrador";
        $u->email = "rodrivt10@gmail.com";
        $u->telefono = "7331214320";
        $u->id_perfil = 1;
        $u->id_estatus = 1;
        $u->creator_user_id = 1;
        $u->save();
    }
}
