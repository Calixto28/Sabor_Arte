<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Detalle_ordenes;
use App\Models\Ordenes;
use App\Models\Productos;
use Illuminate\Http\Request;

class CocinerosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $session = $this->getSession($request);

        $categorias = Categorias::where('id_estatus', 1)->get();
        $ordenes = Ordenes::where('id_estatus', 4)->get();

        $data = array(
            'session' => $session,
            'ordenes' => $ordenes,
            'categorias' => $categorias,
        );

        return view('cocineros/index', $data);
    }

    public function getDetailOrden(Request $request)
    {
        $rows = Detalle_ordenes::where('id_orden', $request->id)->get();
        $data = array();
        foreach($rows as $row){
            $producto = Productos::where('id', $row->id_producto)->first();
            $data[] = array(
                'id' => $row->id,
                'producto' => $producto->producto_descripcion,
                'cantidad' => $row->cantidad,
                'id_estatus' => $row->id_estatus
            );
        }
        return $data;
    }

    public function productoCocinado(Request $request)
    {
        $session = $this->getSession($request);

        $row = Detalle_ordenes::find($request->id);
        $row->id_estatus = 7;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return true;
    }

    public function recetaProducto(Request $request)
    {
        $session = $this->getSession($request);

        $detalle = Detalle_ordenes::find($request->id);
        $producto = Productos::find($detalle->id_producto);
        return $producto->producto_receta;
    }
}
