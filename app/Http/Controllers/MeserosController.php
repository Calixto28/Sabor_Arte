<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Detalle_ordenes;
use App\Models\Ordenes;
use App\Models\Productos;
use Illuminate\Http\Request;

class MeserosController extends Controller
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
        $ordenes = Ordenes::whereIn('id_estatus', [4,5])->get();

        $data = array(
            'session' => $session,
            'ordenes' => $ordenes,
            'categorias' => $categorias,
        );

        return view('meseros/index', $data);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orden(Request $request)
    {
        $session = $this->getSession($request);
        $categorias = Categorias::where('id_estatus', 1)->get();
        $productos = Productos::all();
        //buscar la orden
        $orden = Ordenes::where('id_estatus', 3)->where('id_usuario', $session['id_usuario'])->first();
        $detalles = new Detalle_ordenes();

        $total = 0;
        if ($orden) { //saber si existe orden
            $detalles = Detalle_ordenes::where('id_orden', $orden->id)->get();
            //obtener el total de la venta
            foreach ($detalles as $detalle) {
                $total += $detalle->cantidad * $detalle->precio;
                $producto = Productos::find($detalle->id_producto);
                $detalle->producto = $producto->producto_descripcion;
            }
        }

        $data = array(
            'session' => $session,
            'categorias' => $categorias,
            'productos' => $productos,
            'orden' => $orden,
            'detalles' => $detalles,
            'total' => $total
        );

        return view('meseros/orden', $data);
    }

    public function agregarProducto(Request $request)
    {
        if ($request->cantidad == 0)
            return back();

        $session = $this->getSession($request);
        $orden = Ordenes::where('id_estatus', 3)->where('id_usuario', $session['id_usuario'])->first();

        if (!$orden) {  //no hay orden -> crear una nueva
            $orden = new Ordenes();
            $orden->id_usuario = $session['id_usuario'];
            $orden->creator_user_id = $session['id_usuario'];
            $orden->id_estatus = 3;
            $orden->total = 0;
            $orden->save();
        }
        $producto = Productos::find($request->producto_id);

        $detalle = Detalle_ordenes::where('id_orden',$orden->id)->where('id_producto',$request->producto_id)->first();
        if (empty($detalle)) {  //no hay orden -> crear una nueva
            $detalle = new Detalle_ordenes();
            $detalle->id_orden = $orden->id;
            $detalle->id_producto = $request->producto_id;
            $detalle->cantidad = $request->cantidad;
            $detalle->precio = $producto->precio;
            $detalle->id_estatus = 1;
            $detalle->creator_user_id = $session['id_usuario'];
            $detalle->save();
        } else {
            $id_datalle_orden = $detalle->id;
            $cantidad = $detalle->cantidad;
            $cantidad += $request->cantidad;

            $row = Detalle_ordenes::find($id_datalle_orden);
            $row->cantidad = $cantidad;
            $row->precio = $producto->precio;
            $row->id_estatus = 1;
            $row->updater_user_id = $session['id_usuario'];
            $row->save();
        }

        return back();
    }


    public function generarOrden(Request $request)
    {
        $session = $this->getSession($request);
        $orden = Ordenes::where('id_estatus', 3)->where('id_usuario', $session['id_usuario'])->first();
        $orden->id_estatus = 4;
        $orden->save();
       
        return back();
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

    public function productoEntregado(Request $request)
    {
        $session = $this->getSession($request);

        $row = Detalle_ordenes::find($request->id);
        $row->id_estatus = 8;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return true;
    }

    public function ordenServida(Request $request)
    {
        $session = $this->getSession($request);

        $row = Ordenes::find($request->id);
        $row->id_estatus = 5;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();
        return true;
    }
}
