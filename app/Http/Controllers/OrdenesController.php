<?php

namespace App\Http\Controllers;

use App\Models\Ordenes;
use App\Models\Usuarios;
use App\Models\Detalle_ordenes;
use App\Models\Productos;
use Illuminate\Http\Request;

class OrdenesController extends Controller
{
    public function index(Request $request){
        $session = $this->getSession($request);
        $rows = Ordenes::where('id_estatus',5)->paginate(10);
        $rowsData = array();
        foreach($rows as $row){
            $acciones = array();
            $acciones[] = array(
                'href'  => $request->url().'/detalle/'.$row->id,
                'class' => 'btn-warning ml-1',
                'icon'  => 'fas fa-eye',
                'title' => 'Ver Detalle'
            );
            $acciones[] = array(
                'href'  => $request->url().'/pagar/'.$row->id,
                'class' => 'btn-success ml-1',
                'icon'  => 'fas fa-money-bill',
                'title' => 'Pagar'
            );

            $usuario = Usuarios::select('id','nombre','ape_paterno','ape_materno')->where('id',$row->id_usuario)->first();

            $rowsData[] = array(
                'id' => $row->id,
                'nombre' => $usuario['nombre'].' '.$usuario['ape_paterno'].' '.$usuario['ape_materno'],
                'acciones'          => $acciones
            );
        }

        

        $data = array(
            'session' => $session,
            'title' => 'Ordenes',
            'ordenes_data' => $rowsData,
            'ordenes' => $rows
        );

        return view('header', $data).view('ordenes/list', $data).view('footer', $data);
    }

    public function detalle($id, Request $request)
    {
        $session = $this->getSession($request);
        $detallesOrden = Detalle_ordenes::where('id_orden',$id)->paginate(10);

        $rowsData = array();
        foreach($detallesOrden as $row){
            $producto = Productos::where('id',$row->id_producto)->first();

            $rowsData[] = array(
                'descripcion' => $row->cantidad.'x '.$producto['producto_descripcion'],
                'total' => (float)$row->cantidad * (float)$row->precio
            );
        }

        $data = array(
            'session' => $session,
            'title' => 'Detalle de la Orden #'.$id,
            'rowsData' => $rowsData,
            'detallesOrden' => $detallesOrden,
        );
        return view('header', $data).view('ordenes/detalle', $data).view('footer', $data);
    }

    public function pagar($id, Request $request)
    {
        $session = $this->getSession($request);
        $detallesOrden = Detalle_ordenes::where('id_orden',$id)->paginate(10);

        $total = 0;
        foreach($detallesOrden as $row){
            $total += (float)$row->cantidad * (float)$row->precio;
        }

        $row = Ordenes::find($id);
        $row->total = $total;
        $row->id_estatus = 6;
        $row->updater_user_id = $session['id_usuario'];
        $row->save();

        $data = array(
            'session' => $session,
            'title' => 'Total a pagar de la Orden #'.$id,
            'total' => $total
        );
        return view('header', $data).view('ordenes/pagar', $data).view('footer', $data);
    }
}
