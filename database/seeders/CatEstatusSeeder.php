<?php

namespace Database\Seeders;

use App\Models\Cat_estatus;

use Illuminate\Database\Seeder;

class CatEstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estatus = new Cat_estatus();
        $estatus->estatus_descripcion = "Activo";
        $estatus->creator_user_id = 1;
        $estatus->save();

        $estatus2 = new Cat_estatus();
        $estatus2->estatus_descripcion = "Inactivo";
        $estatus2->creator_user_id = 1;
        $estatus2->save();
    }
}
