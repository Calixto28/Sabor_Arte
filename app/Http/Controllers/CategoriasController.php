<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(Request $request){
        $session = $this->getSession($request);
        $categorias = Categorias::paginate(10);
        $categoriasData = array();
        foreach($categorias as $categoria){
            $acciones = array();
            switch ($categoria->id_estatus) {
                case 1:
                    $acciones[] = array(
                        'href'  => $request->url().'/edit/'.$categoria->id,
                        'class' => 'btn-primary ml-1',
                        'icon'  => 'fas fa-pencil-alt',
                        'title' => 'Editar Registro'
                    );
                    $acciones[] = array(
                        'href'  => $request->url().'/baja/'.$categoria->id,
                        'class' => 'btn-danger ml-1',
                        'icon'  => 'fas fa-trash',
                        'title' => 'Desactivar Registro'
                    );
                    break;
                default:
                    $acciones[] = array(
                        'href'  => $request->url().'/alta/'.$categoria->id,
                        'class' => 'btn-warning',
                        'icon'  => 'fas fa-check',
                        'title' => 'Activar Registro'
                    );
                    break;
            }
            $categoriasData[] = array(
                'id' => $categoria->id,
                'categoria_descripcion' => $categoria->categoria_descripcion,
                'orden' => $categoria->orden,
                'acciones'          => $acciones
            );
        }
        $data = array(
            'session' => $session,
            'title' => 'Categorías',
            'action' => $request->url().'/create',
            'categorias_data' => $categoriasData,
            'categorias' => $categorias
        );
        return view('header', $data).view('categorias/list', $data).view('footer', $data);
    }

    public function create(Request $request){
        $session = $this->getSession($request);
        $data = array(
            'session' => $session,
            'button' => 'Crear',
            'title' => 'Crear Categoría',
            'action' => $session['route'].'/categorias/store',
            'url_img' => url()->previous(),
            'method' => false,
            'id' => '',
            'categoria_descripcion' => '',
            'orden' => ''
        );
        return view('header', $data).view('categorias/form', $data).view('footer', $data);
    }

    public function store(Request $request){
        $session = $this->getSession($request);

        $row = new Categorias();
        echo e($request->categoria_nota_es);
        $row->categoria_descripcion = $request->categoria_descripcion;
        $row->orden =  $request->orden;
        $row->id_estatus = 1;
        $row->creator_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/categorias');
    }

    public function edit($id, Request $request){
        $session = $this->getSession($request);

        $categoria = Categorias::find($id);
        $data = array(
            'session' => $session,
            'button' => 'Editar',
            'title' => 'Editar Categoría',
            'action' => $session['route'].'/categorias/update',
            'method' => true,
            'id' => $categoria->id,
            'categoria_descripcion' => $categoria->categoria_descripcion,
            'orden' => $categoria->orden
        );
        return view('header', $data).view('categorias/form', $data).view('footer', $data);
    }

    public function update(Request $request){
        $session = $this->getSession($request);

        $row = Categorias::find($request->id);
        $row->categoria_descripcion = $request->categoria_descripcion;
        $row->orden = $request->orden;
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/categorias');
    }

    public function baja($id, Request $request){
        $session = $this->getSession($request);
        $row = Categorias::find($id);
        $row->id_estatus = 2;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/categorias');
    }

    public function alta($id, Request $request){
        $session = $this->getSession($request);
        $row = Categorias::find($id);
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/categorias');
    }
}
