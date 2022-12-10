<?php

namespace App\Http\Controllers;

use App\Models\Cat_perfiles;
use Illuminate\Http\Request;

class PerfilesController extends Controller
{
    public function index(Request $request){
        $session = $this->getSession($request);
        $perfiles = Cat_perfiles::paginate(10);
        $perfilesData = array();
        foreach($perfiles as $perfil){
            $acciones = array();
            switch ($perfil->id_estatus) {
                case 1:
                    $acciones[] = array(
                        'href'  => $request->url().'/edit/'.$perfil->id,
                        'class' => 'btn-primary ml-1',
                        'icon'  => 'fas fa-pencil-alt',
                        'title' => 'Editar Registro'
                    );
                    $acciones[] = array(
                        'href'  => $request->url().'/baja/'.$perfil->id,
                        'class' => 'btn-danger ml-1',
                        'icon'  => 'fas fa-trash',
                        'title' => 'Desactivar Registro'
                    );
                    break;
                default:
                    $acciones[] = array(
                        'href'  => $request->url().'/alta/'.$perfil->id,
                        'class' => 'btn-warning',
                        'icon'  => 'fas fa-check',
                        'title' => 'Activar Registro'
                    );
                    break;
            }
            $perfilesData[] = array(
                'id' => $perfil->id,
                'perfil_descripcion' => $perfil->perfil_descripcion,
                'acciones'          => $acciones
            );
        }
        $data = array(
            'session' => $session,
            'title' => 'Perfiles',
            'action' => $request->url().'/create',
            'perfiles_data' => $perfilesData,
            'perfiles' => $perfiles
        );
        return view('header', $data).view('perfiles/list', $data).view('footer', $data);
    }

    public function create(Request $request){
        $session = $this->getSession($request);
        $data = array(
            'session' => $session,
            'button' => 'Crear',
            'title' => 'Crear Perfil',
            'action' => $session['route'].'/perfiles/store',
            'method' => false,
            'id' => '',
            'perfil_descripcion' => ''
        );
        return view('header', $data).view('perfiles/form', $data).view('footer', $data);
    }

    public function store(Request $request){
        $session = $this->getSession($request);
        $row = new Cat_perfiles();
        $row->perfil_descripcion = $request->perfil_descripcion;
        $row->id_estatus = 1;
        $row->creator_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/perfiles');
    }

    public function edit($id, Request $request){
        $session = $this->getSession($request);
        $perfil = Cat_perfiles::find($id);
        $data = array(
            'session' => $session,
            'button' => 'Editar',
            'title' => 'Editar Opción Menú',
            'action' => $session['route'].'/perfiles/update',
            'method' => true,
            'id' => $perfil->id,
            'perfil_descripcion' => $perfil->perfil_descripcion
        );
        return view('header', $data).view('perfiles/form', $data).view('footer', $data);
    }

    public function update(Request $request){
        $session = $this->getSession($request);
        $row = Cat_perfiles::find($request->id);
        $row->perfil_descripcion = $request->perfil_descripcion;
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/perfiles');
    }

    public function baja($id, Request $request){
        $session = $this->getSession($request);
        $row = Cat_perfiles::find($id);
        $row->id_estatus = 2;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/perfiles');
    }

    public function alta($id, Request $request){
        $session = $this->getSession($request);
        $row = Cat_perfiles::find($id);
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/perfiles');
    }
}
