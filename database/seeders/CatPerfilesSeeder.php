<?php

namespace Database\Seeders;

use App\Models\Cat_perfiles;
use Illuminate\Database\Seeder;

class CatPerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles = new Cat_perfiles();
        $perfiles->perfil_descripcion = "Administrador";
        $perfiles->id_estatus = 1;
        $perfiles->creator_user_id = 1;
        $perfiles->save();
    }
}
