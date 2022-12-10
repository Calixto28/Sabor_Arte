<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat_perfiles;
use App\Models\Opciones_menu;
use App\Models\Permisos_perfiles;

class PermisosController extends Controller
{
    public function index(Request $request){
        $session = $this->getSession($request);
        $perfiles = Cat_perfiles::where('id_estatus',1)->paginate(10);
        $perfilesData = array();
        foreach($perfiles as $perfil){
            $acciones = array();
            $acciones[] = array(
                'href'  => $request->url().'/asignacion/'.$perfil->id,
                'class' => 'btn-warning',
                'icon'  => 'fas fa-plus',
                'title' => 'Asignar Permisos'
            );
            $perfilesData[] = array(
                'id' => $perfil->id,
                'perfil_descripcion' => $perfil->perfil_descripcion,
                'acciones'          => $acciones
            );
        }
        $data = array(
            'session' => $session,
            'title' => 'Permisos de Perfiles',
            'perfiles_data' => $perfilesData,
            'perfiles' => $perfiles
        );
        return view('header', $data).view('permisos/list', $data).view('footer', $data);
    }

    public function asignacion($id, Request $request)
    {
        $session = $this->getSession($request);
        $opciones_parents = Opciones_menu::where('parent_menu_id', 0)->where('id_estatus',1)->orderBy('orden', 'ASC')->get();

        $row_perfil = Cat_perfiles::where('id',$id)->first();
        $perfil = array(
            'id_perfil' => $row_perfil->id,
            'perfil_descripcion' => $row_perfil->perfil_descripcion,
        );
        $permisos = Permisos_perfiles::where('id_perfil',$id)->where('id_estatus',1)->get();

        $opciones_menu = null;
        foreach ($opciones_parents as $opcion_parent) {
            $checked = false;
            foreach ($permisos as $permiso){
                if($opcion_parent->id == $permiso->id){
                    $checked = true;
                }
            }
            $opciones_children = Opciones_menu::where('parent_menu_id',$opcion_parent->id)->where('id_estatus',1)->orderBy('orden', 'ASC')->get();
            $opcionesChildren = null;
            foreach ($opciones_children as $opcion_children){
                $checked_son = false;
                foreach ($permisos as $permiso){
                    if($opcion_children->id == $permiso->id){
                        $checked_son = true;
                    }
                }
                $opcionesChildren[] = array(
                    'parent_menu_id' => $opcion_parent->id,
                    'id_menu' => $opcion_children->id,
                    'etiqueta' => $opcion_children->etiqueta,
                    'checked' => ($checked_son == true) ? 'checked' : '',
                );
            }
            $opciones_menu[] = array(
                'id_menu' => $opcion_parent->id,
                'etiqueta' => $opcion_parent->etiqueta,
                'id_estatus' => $opcion_parent->id_estatus,
                'fa_icon' => $opcion_parent->fa_icon,
                'checked' => ($checked == true) ? 'checked' : '',
                'opciones_children' => $opcionesChildren,
            );
        }

        $data = [
            'session' => $session,
            'title' => 'Asignación de Permisos',
            'button' => 'Asignar',
            'action' => url()->previous().'/update',
            'method' => true,
            'perfil' => $perfil,
            'opciones_menu' => $opciones_menu,
            'opciones_children' => $opcionesChildren,

        ];

        return view('header', $data).view('permisos/form', $data).view('footer', $data);
    }

    public function update(Request $request)
    {
        $session = $this->getSession($request);

        foreach($_POST as $id_menu => $val)
        {
            $permiso = Permisos_perfiles::where('id_perfil',$request->id)->where('id_menu',$id_menu)->first();
            if($permiso == null){
                if(is_numeric($id_menu)){
                    $row = new Permisos_perfiles();
                    $row->id_perfil = $request->id;
                    $row->id_menu = $id_menu;
                    $row->id_estatus = 1;
                    $row->creator_user_id = $session['id_usuario'];
                    $row->save();
                }
            }else{
                if(($permiso->id_estatus) == 2){
                    $row = Permisos_perfiles::find($permiso->id);
                    $row->id_estatus = 1;
                    $row->updater_user_id = $session['id_usuario'];
                    $row->save();
                }
            }
        }
        $permisos = Permisos_perfiles::where('id_perfil',$request->id)->get();
        foreach ($permisos as $permiso){
            if(!isset($_POST[$permiso->id_menu])){
                $row = Permisos_perfiles::find($permiso->id);
                $row->id_estatus = 2;
                $row->updater_user_id = $session['id_usuario'];
                $row->save();
            }
        }
        return redirect('/permisos');
    }
}
