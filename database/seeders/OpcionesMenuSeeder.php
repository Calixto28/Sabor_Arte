<?php

namespace Database\Seeders;

use App\Models\Opciones_menu;
use Illuminate\Database\Seeder;

class OpcionesMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $op = new Opciones_menu();
        $op->etiqueta = "Admin Usuario";
        $op->url = "";
        $op->parent_menu_id = 0;
        $op->fa_icon = "fa-laptop";
        $op->orden = 0;
        $op->id_estatus = 1;
        $op->creator_user_id = 1;
        $op->save();

        $op1 = new Opciones_menu();
        $op1->etiqueta = "Configuracion";
        $op1->url = "configuracion";
        $op1->parent_menu_id = 1;
        $op1->fa_icon = "";
        $op1->orden = 0;
        $op1->id_estatus = 1;
        $op1->creator_user_id = 1;
        $op1->save();

        $op2 = new Opciones_menu();
        $op2->etiqueta = "Menú";
        $op2->url = "opciones_menu";
        $op2->parent_menu_id = 1;
        $op2->fa_icon = "";
        $op2->orden = 1;
        $op2->id_estatus = 1;
        $op2->creator_user_id = 1;
        $op2->save();

        $op3 = new Opciones_menu();
        $op3->etiqueta = "Perfiles";
        $op3->url = "perfiles";
        $op3->parent_menu_id = 1;
        $op3->fa_icon = "";
        $op3->orden = 2;
        $op3->id_estatus = 1;
        $op3->creator_user_id = 1;
        $op3->save();

        $op4 = new Opciones_menu();
        $op4->etiqueta = "Permisos";
        $op4->url = "permisos";
        $op4->parent_menu_id = 1;
        $op4->fa_icon = "";
        $op4->orden = 3;
        $op4->id_estatus = 1;
        $op4->creator_user_id = 1;
        $op4->save();

        $op5 = new Opciones_menu();
        $op5->etiqueta = "Usuarios";
        $op5->url = "usuarios";
        $op5->parent_menu_id = 1;
        $op5->fa_icon = "";
        $op5->orden = 4;
        $op5->id_estatus = 1;
        $op5->creator_user_id = 1;
        $op5->save();

        $op6 = new Opciones_menu();
        $op6->etiqueta = "Catálogos";
        $op6->url = "opciones_menu";
        $op6->parent_menu_id = 0;
        $op6->fa_icon = "fa-book";
        $op6->orden = 1;
        $op6->id_estatus = 1;
        $op6->creator_user_id = 1;
        $op6->save();

        $op7 = new Opciones_menu();
        $op7->etiqueta = "Categorías";
        $op7->url = "categorias";
        $op7->parent_menu_id = 6;
        $op7->fa_icon = "";
        $op7->orden = 0;
        $op7->id_estatus = 1;
        $op7->creator_user_id = 1;
        $op7->save();

        $op8 = new Opciones_menu();
        $op8->etiqueta = "Subcategorías";
        $op8->url = "subcategorias";
        $op8->parent_menu_id = 6;
        $op8->fa_icon = "";
        $op8->orden = 1;
        $op8->id_estatus = 1;
        $op8->creator_user_id = 1;
        $op8->save();

        $op9 = new Opciones_menu();
        $op9->etiqueta = "Productos";
        $op9->url = "productos";
        $op9->parent_menu_id = 6;
        $op9->fa_icon = "";
        $op9->orden = 2;
        $op9->id_estatus = 1;
        $op9->creator_user_id = 1;
        $op9->save();
    }
}
