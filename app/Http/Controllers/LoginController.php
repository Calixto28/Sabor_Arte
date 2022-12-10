<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request){
        $username = $request->usuario;
        $password = $request->password;
        $user = DB::table('usuarios')->where('username',$username)->first();
        if($user){
            if($user->id_estatus == 1){
                if($user->intentos != 3){
                    if (password_verify($password, $user->password)) {
                        
                        if($user->intentos != 0){
                            $row = Usuarios::find($user->id);
                            $row->intentos = 0;
                            $row->updater_user_id = $user->id;
                            $row->save();
                        }
                        $permisos = DB::table('permisos_perfiles')->where('id_perfil', $user->id_perfil)->where('id_estatus',1)->get();
                        $menu = array();
                        foreach($permisos as $row){
                            $parent = DB::table('opciones_menu')->where('id', $row->id_menu)->first();
                            if($parent->parent_menu_id == 0){
                                $children_menu = null;
                                $children_parent = DB::table('opciones_menu')->where('parent_menu_id',$parent->id)->get();
                                foreach($children_parent as $son_parent){
                                    
                                    $validate_son = false;
                                    foreach($permisos as $permiso){
                                        if($son_parent->id == $permiso->id_menu){
                                            $validate_son = true;
                                        }
                                    }
                                    if($validate_son == true){
                                        $children_menu[] = array(
                                            'id_menu' => $son_parent->id,
                                            'etiqueta' => $son_parent->etiqueta,
                                            'url' => $son_parent->url,
                                        );
                                    }
                                }
                                $menu[] = array(
                                    'id_permiso_perfil' => $permiso->id,
                                    'id_menu' => $permiso->id_menu,
                                    'id_perfil' => $permiso->id_perfil,
                                    'etiqueta' => $parent->etiqueta,
                                    'fa_icon' => $parent->fa_icon,
                                    'children_menu' => $children_menu,
                                );
                            }
                        }
                        session([
                            'id_usuario' => $user->id,
                            'username' => $user->username,
                            'nombre' => $user->nombre,
                            'ape_paterno' => $user->ape_paterno,
                            'ape_materno' => $user->ape_materno,
                            'id_perfil' => $user->id_perfil,
                            'route' => $request->root(),
                            'menu' => $menu
                        ]);
                        switch($user->id_perfil){
                            case 1:
                                return redirect('/ordenes');
                                break;
                            case 2:
                                return redirect('/mesero');
                                break;
                            case 3:
                                return redirect('/cocinero');
                                break;
                            case 4:
                                return redirect('/cliente');
                                break;
                        }
                    } else {
                        $row = Usuarios::find($user->id);
                        $row->intentos = $user->intentos + 1;
                        $row->updater_user_id = $user->id;
                        $row->save();
                        return redirect('/login?response=503');
                    }
                }else{
                    return redirect('/login?response=504');
                }
            }else{
                return redirect('/login?response=502');
            }
        }else{
            return redirect('/login?response=501');
        }
    }

    public function logout(Request $request)
    {
        $session = $this->getSession($request);
        $request->session()->flush();
        return redirect('/login');
    }
}
