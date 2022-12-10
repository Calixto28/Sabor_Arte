<?php

namespace Database\Seeders;

use App\Models\Permisos_perfiles;
use Illuminate\Database\Seeder;

class PermisosPerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pp = new Permisos_perfiles();
        $pp->id_perfil = 1;
        $pp->id_estatus = 1;
        $pp->id_menu = 1;
        $pp->creator_user_id = 1;
        $pp->save();

        $pp1 = new Permisos_perfiles();
        $pp1->id_perfil = 1;
        $pp1->id_estatus = 1;
        $pp1->id_menu = 2;
        $pp1->creator_user_id = 1;
        $pp1->save();

        $pp2 = new Permisos_perfiles();
        $pp2->id_perfil = 1;
        $pp2->id_estatus = 1;
        $pp2->id_menu = 3;
        $pp2->creator_user_id = 1;
        $pp2->save();

        $pp3 = new Permisos_perfiles();
        $pp3->id_perfil = 1;
        $pp3->id_estatus = 1;
        $pp3->id_menu = 4;
        $pp3->creator_user_id = 1;
        $pp3->save();

        $pp4 = new Permisos_perfiles();
        $pp4->id_perfil = 1;
        $pp4->id_estatus = 1;
        $pp4->id_menu = 5;
        $pp4->creator_user_id = 1;
        $pp4->save();

        $pp5 = new Permisos_perfiles();
        $pp5->id_perfil = 1;
        $pp5->id_estatus = 1;
        $pp5->id_menu = 6;
        $pp5->creator_user_id = 1;
        $pp5->save();

        $pp6 = new Permisos_perfiles();
        $pp6->id_perfil = 1;
        $pp6->id_estatus = 1;
        $pp6->id_menu = 7;
        $pp6->creator_user_id = 1;
        $pp6->save();

        $pp7 = new Permisos_perfiles();
        $pp7->id_perfil = 1;
        $pp7->id_estatus = 1;
        $pp7->id_menu = 8;
        $pp7->creator_user_id = 1;
        $pp7->save();

        $pp8 = new Permisos_perfiles();
        $pp8->id_perfil = 1;
        $pp8->id_estatus = 1;
        $pp8->id_menu = 9;
        $pp8->creator_user_id = 1;
        $pp8->save();

        $pp9 = new Permisos_perfiles();
        $pp9->id_perfil = 1;
        $pp9->id_estatus = 1;
        $pp9->id_menu = 10;
        $pp9->creator_user_id = 1;
        $pp9->save();
    }
}
