<?php

namespace App\Http\Controllers;

use App\Models\Cat_perfiles;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index(Request $request){
        $session = $this->getSession($request);
        $usuarios = Usuarios::select('usuarios.id','usuarios.username','usuarios.nombre','usuarios.ape_paterno','usuarios.ape_materno','usuarios.email','usuarios.telefono','cat_perfiles.perfil_descripcion','usuarios.id_estatus')->leftjoin('cat_perfiles', 'cat_perfiles.id', '=', 'usuarios.id_perfil')->paginate(10);
        $usuariosData = array();
        foreach($usuarios as $usuario){
            $acciones = array();
            switch ($usuario->id_estatus) {
                case 1:
                    $acciones[] = array(
                        'href'  => $request->url().'/edit/'.$usuario->id,
                        'class' => 'btn-primary ml-1 mr-1',
                        'icon'  => 'fas fa-pencil-alt',
                        'title' => 'Editar Registro'
                    );
                    $acciones[] = array(
                        'href'  => $request->url().'/baja/'.$usuario->id,
                        'class' => 'btn-danger ml-1 mr-1',
                        'icon'  => 'fas fa-trash',
                        'title' => 'Desactivar Registro'
                    );
                    break;
                default:
                    $acciones[] = array(
                        'href'  => $request->url().'/alta/'.$usuario->id,
                        'class' => 'btn-warning',
                        'icon'  => 'fas fa-check',
                        'title' => 'Activar Registro'
                    );
                    break;
            }
            $usuariosData[] = array(
                'id' => $usuario->id,
                'username' => $usuario->username,
                'nombre' => $usuario->nombre,
                'ape_paterno' => $usuario->ape_paterno,
                'ape_materno' => $usuario->ape_materno,
                'email' => $usuario->email,
                'telefono' => $usuario->telefono,
                'perfil_descripcion' => $usuario->perfil_descripcion,
                'acciones'          => $acciones
            );
        }
        $data = array(
            'session' => $session,
            'title' => 'Usuarios',
            'action' => $request->url().'/create',
            'usuarios_data' => $usuariosData,
            'usuarios' => $usuarios
        );
        return view('header', $data).view('usuarios/list', $data).view('footer', $data);
    }

    public function create(Request $request){
        $session = $this->getSession($request);
        $perfiles = Cat_perfiles::select('id','perfil_descripcion')->where('id_estatus',1)->get();
        $data = array(
            'session' => $session,
            'button' => 'Crear',
            'title' => 'Crear Usuario',
            'action' => $session['route'].'/usuarios/store',
            'method' => false,
            'id' => '',
            'username' => '',
            'password' => '',
            'display_password' => true,
            'nombre' => '',
            'ape_paterno' => '',
            'ape_materno' => '',
            'email' => '',
            'telefono' => '',
            'id_perfil' => '',
            'perfiles' => $perfiles,
        );
        return view('header', $data).view('usuarios/form', $data).view('footer', $data);
    }

    public function store(Request $request){
        $session = $this->getSession($request);
        $row = new Usuarios();
        $row->username = $request->username;
        $row->password = password_hash($request->password, PASSWORD_DEFAULT);
        $row->nombre = $request->nombre;
        $row->ape_paterno = $request->ape_paterno;
        $row->ape_materno = $request->ape_materno;
        $row->email = $request->email;
        $row->telefono = $request->telefono;
        $row->id_perfil = $request->id_perfil;
        $row->id_estatus = 1;
        $row->creator_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/usuarios');
    }

    public function edit($id, Request $request){
        $session = $this->getSession($request);
        $usuario = Usuarios::find($id);
        $perfiles = Cat_perfiles::select('id','perfil_descripcion')->where('id_estatus',1)->get();
        $data = array(
            'session' => $session,
            'button' => 'Editar',
            'title' => 'Editar Usuario',
            'action' => $session['route'].'/usuarios/update',
            'method' => true,
            'id' => $usuario->id,
            'username' => $usuario->username,
            'password' => $usuario->password,
            'display_password' => false,
            'nombre' => $usuario->nombre,
            'ape_paterno' => $usuario->ape_paterno,
            'ape_materno' => $usuario->ape_materno,
            'email' => $usuario->email,
            'telefono' => $usuario->telefono,
            'id_perfil' => $usuario->id_perfil,
            'perfiles' => $perfiles,
        );
        return view('header', $data).view('usuarios/form', $data).view('footer', $data);
    }

    public function update(Request $request){
        $session = $this->getSession($request);
        $row = Usuarios::find($request->id);
        $row->username = $request->username;
        $row->nombre = $request->nombre;
        $row->ape_paterno = $request->ape_paterno;
        $row->ape_materno = $request->ape_materno;
        $row->email = $request->email;
        $row->telefono = $request->telefono;
        $row->id_perfil = $request->id_perfil;
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/usuarios');
    }

    public function baja($id, Request $request){
        $session = $this->getSession($request);
        $row = Usuarios::find($id);
        $row->id_estatus = 2;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/usuarios');
    }

    public function alta($id, Request $request){
        $session = $this->getSession($request);
        $row = Usuarios::find($id);
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/usuarios');
    }

    public function desbloquear($id, Request $request){
        $session = $this->getSession($request);
        $row = Usuarios::find($id);
        $row->intentos = 0;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/usuarios');
    }
}
