<?php

namespace Database\Seeders;

use App\Models\Cat_errores;
use Illuminate\Database\Seeder;

class CatErroresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ce = new Cat_errores();
        $ce->codigo_error = "500";
        $ce->error_descripcion = "Error del sistema";
        $ce->creator_user_id = 1;
        $ce->save();

        $ce1 = new Cat_errores();
        $ce1->codigo_error = "501";
        $ce1->error_descripcion = "Error usuario y contraseña incorrectos";
        $ce1->creator_user_id = 1;
        $ce1->save();

        $ce2 = new Cat_errores();
        $ce2->codigo_error = "502";
        $ce2->error_descripcion = "Error el usuario esta dado de baja";
        $ce2->creator_user_id = 1;
        $ce2->save();

        $ce3 = new Cat_errores();
        $ce3->codigo_error = "503";
        $ce3->error_descripcion = "Error contraseña incorrecta";
        $ce3->creator_user_id = 1;
        $ce3->save();
    }
}
