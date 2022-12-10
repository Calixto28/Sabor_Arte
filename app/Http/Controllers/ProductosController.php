<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categorias;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index(Request $request){
        $session = $this->getSession($request);
        $productos = Productos::select('productos.id','productos.producto_descripcion','c.categoria_descripcion','productos.id_estatus')->leftjoin('categorias as c', 'c.id', '=', 'productos.id_categoria')->paginate(10);
        $productosData = array();
        foreach($productos as $producto){
            $acciones = array();
            switch ($producto->id_estatus) {
                case 1:
                    $acciones[] = array(
                        'href'  => $request->url().'/edit/'.$producto->id,
                        'class' => 'btn-primary ml-1',
                        'icon'  => 'fas fa-pencil-alt',
                        'title' => 'Editar Registro'
                    );
                    $acciones[] = array(
                        'href'  => $request->url().'/baja/'.$producto->id,
                        'class' => 'btn-danger ml-1',
                        'icon'  => 'fas fa-trash',
                        'title' => 'Desactivar Registro'
                    );
                    break;
                default:
                    $acciones[] = array(
                        'href'  => $request->url().'/alta/'.$producto->id,
                        'class' => 'btn-warning',
                        'icon'  => 'fas fa-check',
                        'title' => 'Activar Registro'
                    );
                    break;
            }
            $productosData[] = array(
                'id' => $producto->id,
                'producto_descripcion' => $producto->producto_descripcion,
                'categoria_descripcion' => $producto->categoria_descripcion,
                'acciones'          => $acciones
            );
        }
        $data = array(
            'session' => $session,
            'title' => 'Productos',
            'action' => $request->url().'/create',
            'productos_data' => $productosData,
            'productos' => $productos
        );
        return view('header', $data).view('productos/list', $data).view('footer', $data);
    }

    public function create(Request $request){
        $session = $this->getSession($request);
        $categorias = Categorias::select('id','categoria_descripcion')->where('id_estatus',1)->get();
        $data = array(
            'session' => $session,
            'button' => 'Crear',
            'title' => 'Crear Producto',
            'action' => $session['route'].'/productos/store',
            'url_img' => $session['route'],
            'method' => false,
            'id' => '',
            'producto_descripcion' => '',
            'producto_detalle' => '',
            'producto_receta' => '',
            'precio' => '',
            'id_categoria' => '',
            'orden' => '',
            'multimedia' => '',
            'multimedia_old' => '',
            'active_multimedia' => '',
            'type_multimedia' => '',
            'categorias' => $categorias,
        );
        return view('header', $data).view('productos/form', $data).view('footer', $data);
    }

    public function store(Request $request){
        $session = $this->getSession($request);

        $fileName = '';
        $path = 0;
        if($request->multimedia_new != ''){
            if($_FILES['file']['name'] != ''){
                $fecha = date("YmdHis");
                $fileName = $fecha.'_'.$_FILES['file']['name'];
                $fileTmpLoc = $_FILES['file']['tmp_name'];
                $path = 1;
            }
        }

        $row = new Productos();
        $row->producto_descripcion = $request->producto_descripcion;
        $row->producto_detalle = $request->producto_detalle;
        $row->producto_receta = $request->producto_receta;
        $row->precio = $request->precio;
        $row->multimedia = $fileName;
        $row->id_categoria = $request->id_categoria;
        $row->orden = $request->orden;
        $row->id_estatus = 1;
        $row->creator_user_id = $session['id_usuario'];
        $row->save();

        $data = Productos::latest('id')->first();

        if($path != 0){
            $dir = 'assets/productos/';
            $destino = 'assets/productos/'.$fileName;
            if(!file_exists($dir)){
                mkdir($dir, 0777, true);
            };
            if(move_uploaded_file($fileTmpLoc, $destino)){
                echo $fileName." movido correctamente";
            }else{
                echo "No se ha podido mover el archivo: ".$fileName;
            }
        }
        return redirect('/productos');
    }

    public function edit($id, Request $request){
        $session = $this->getSession($request);
        $producto = Productos::find($id);
        $categorias = Categorias::select('id','categoria_descripcion')->where('id_estatus',1)->get();
        $formato = '';
        if($producto->multimedia != ''){
            $formatos = explode(".",$producto->multimedia);
            if(isset($formatos[1]))
                $formato = $formatos[1];
        }
        $data = array(
            'session' => $session,
            'button' => 'Editar',
            'title' => 'Editar Producto',
            'action' => $session['route'].'/productos/update',
            'method' => true,
            'id' => $producto->id,
            'producto_descripcion' => $producto->producto_descripcion,
            'producto_detalle' => $producto->producto_detalle,
            'producto_receta' => $producto->producto_receta,
            'precio' => $producto->precio,
            'id_categoria' => $producto->id_categoria,
            'orden' => $producto->orden,
            'multimedia' => $producto->multimedia,
            'multimedia_old' => $producto->multimedia,
            'active_multimedia' => ($producto->multimedia == '') ? '' : 'active',
            'type_multimedia' => ($formato == 'mp4') ? 'video' : 'image',
            'categorias' => $categorias,
        );
        return view('header', $data).view('productos/form', $data).view('footer', $data);
    }

    public function update(Request $request){
        $session = $this->getSession($request);

        $id = $request->id;
        $fileName = $request->multimedia;

        if($request->multimedia == ''){
            if($_FILES['file']['name'] != ''){
                $fecha = date("YmdHis");
                $fileName = $fecha.'_'.$_FILES['file']['name'];
                $fileTmpLoc = $_FILES['file']['tmp_name'];

                $dir = 'assets/productos/';
                $destino = 'assets/productos/'.$fileName;
                if(!file_exists($dir)){
                    mkdir($dir, 0777, true);
                };
                if(move_uploaded_file($fileTmpLoc, $destino)){
                    echo $fileName." movido correctamente";
                }else{
                    echo "No se ha podido mover el archivo: ".$fileName;
                }
            }
            $url_promotional_old = $request->multimedia_old;
            if($url_promotional_old != ''){
                $delete_local = 'assets/productos/'.$url_promotional_old;
                unlink($delete_local);
            }
        }

        $row = Productos::find($request->id);
        $row->producto_descripcion = $request->producto_descripcion;
        $row->producto_detalle = $request->producto_detalle;
        $row->producto_receta = $request->producto_receta;
        $row->precio = $request->precio;
        $row->multimedia = $fileName;
        $row->id_categoria = $request->id_categoria;
        $row->orden = $request->orden;
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/productos');
    }

    public function baja($id, Request $request){
        $session = $this->getSession($request);
        $row = Productos::find($id);
        $row->id_estatus = 2;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/productos');
    }

    public function alta($id, Request $request){
        $session = $this->getSession($request);
        $row = Productos::find($id);
        $row->id_estatus = 1;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return redirect('/productos');
    }
}
