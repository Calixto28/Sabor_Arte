<?php

namespace App\Http\Controllers;

use App\Models\Configuraciones;
use App\Models\Usuarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegistrarseController extends Controller
{
    public function index(){
        return view('registrarse');
    }

    public function registro(Request $request){
        $row = new Usuarios();
        $row->username = $request->username;
        $row->password = password_hash($request->password, PASSWORD_DEFAULT);
        $row->nombre = $request->nombre;
        $row->ape_paterno = $request->ape_paterno;
        $row->ape_materno = $request->ape_materno;
        $row->email = $request->email;
        $row->telefono = $request->telefono;
        $row->id_perfil = 4;
        $row->id_estatus = 1;
        $row->creator_user_id = 1;
        $row->save();
        return redirect('/login?response=200');
    }
}
