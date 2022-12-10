<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opciones_menu;

class OpcionesMenuController extends Controller
{
    public function index(Request $request){
        $session = $this->getSession($request);
        $opcionesMenu = Opciones_menu::select('opciones_menu.id','opciones_menu.etiqueta','opciones_menu.url','opciones_menu.fa_icon','opciones_menu.orden', 'opciones_menu.id_estatus', 'om2.etiqueta as parent')->leftjoin('opciones_menu as om2', 'om2.id', '=', 'opciones_menu.parent_menu_id')->paginate(10);
        $opcionesMenuData = array();
        foreach($opcionesMenu as $opcionMenu){
            $acciones = array();
            switch ($opcionMenu->id_estatus) {
                case 1:
                    $acciones[] = array(
                        'href'  => $request->url().'/edit/'.$opcionMenu->id,
                        'class' => 'btn-primary ml-1',
                        'icon'  => 'fas fa-pencil-alt',
                        'title' => 'Editar Registro'
                    );
                    $acciones[] = array(
                        'href'  => $request->url().'/baja/'.$opcionMenu->id,
                        'class' => 'btn-danger ml-1',
                        'icon'  => 'fas fa-trash',
                        'title' => 'Desactivar Registro'
                    );
                    break;
                default:
                    $acciones[] = array(
                        'href'  => $request->url().'/alta/'.$opcionMenu->id,
                        'class' => 'btn-warning',
                        'icon'  => 'fas fa-check',
                        'title' => 'Activar Registro'
                    );
                    break;
            }
            $opcionesMenuData[] = array(
                'id' => $opcionMenu->id,
                'etiqueta' => $opcionMenu->etiqueta,
                'url'  => ($opcionMenu->url != null) ? $opcionMenu->url : '',
                'parent' => $opcionMenu->parent,
                'fa_icon' => ($opcionMenu->fa_icon != null) ? $opcionMenu->fa_icon : '',
                'orden' => $opcionMenu->orden,
                'acciones' => $acciones
            );
        }
        $data = array(
            'session' => $session,
            'title' => 'Opciones Menú',
            'action' => $request->url().'/create',
            'opciones_menu_data' => $opcionesMenuData,
            'opciones_menu' => $opcionesMenu
        );
        return view('header', $data).view('opciones_menu/list', $data).view('footer', $data);
    }

    public function create(Request $request){
        $session = $this->getSession($request);
        $parents = Opciones_menu::select('id','etiqueta')->where('parent_menu_id',0)->get();
        $data = array(
            'session' => $session,
            'button' => 'Crear',
            'title' => 'Crear Opción Menú',
            'action' => $session['route'].'/opciones_menu/store',
            'method' => false,
            'id' => '',
            'etiqueta' => '',
            'url' => '',
            'disabled_url' => 'disabled',
            'fa_icon' => '',
            'disabled_fa_icon' => '',
            'orden' => '',
            'parent_menu_id' => '',
            'list_parents' => $parents
        );
        return view('header', $data).view('opciones_menu/form', $data).view('footer', $data);
    }

    public function store(Request $request){
        $session = $this->getSession($request);
        $row = new Opciones_menu();
        $row->etiqueta = $request->etiqueta;
        $row->url = $request->url;
        $row->parent_menu_id = $request->parent_menu_id;
        $row->fa_icon = $request->fa_icon;
        $row->orden = $request->orden;
        $row->id_estatus = 1;
        $row->creator_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/opciones_menu');
    }

    public function edit($id, Request $request){
        $session = $this->getSession($request);
        $opcionMenu = Opciones_menu::find($id);
        $parents = Opciones_menu::select('id','etiqueta')->where('parent_menu_id',0)->get();
        $data = array(
            'session' => $session,
            'button' => 'Editar',
            'title' => 'Editar Opción Menú',
            'action' => $session['route'].'/opciones_menu/update',
            'method' => true,
            'id' => $opcionMenu->id,
            'etiqueta' => $opcionMenu->etiqueta,
            'url' => $opcionMenu->url,
            'disabled_url' => ($opcionMenu->url != null) ? '' : 'disabled',
            'fa_icon' => $opcionMenu->fa_icon,
            'disabled_fa_icon' => ($opcionMenu->fa_icon != null) ? '' : 'disabled',
            'orden' => $opcionMenu->orden,
            'parent_menu_id' => $opcionMenu->parent_menu_id,
            'list_parents' => $parents
        );
        return view('header', $data).view('opciones_menu/form', $data).view('footer', $data);
    }

    public function update(Request $request){
        $session = $this->getSession($request);
        $row = Opciones_menu::find($request->id);
        $row->etiqueta = $request->etiqueta;
        $row->url = $request->url;
        $row->parent_menu_id = $request->parent_menu_id;
        $row->fa_icon = $request->fa_icon;
        $row->orden = $request->orden;
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/opciones_menu');
    }

    public function baja($id, Request $request){
        $session = $this->getSession($request);
        $row = Opciones_menu::find($id);
        $row->id_estatus = 2;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/opciones_menu');
    }

    public function alta($id, Request $request){
        $session = $this->getSession($request);
        $row = Opciones_menu::find($id);
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/opciones_menu');
    }
}
