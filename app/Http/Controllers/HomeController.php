<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Venta;

use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        
        return view('dashboard');
    }

    public function inventarios() {
        $inventarios = Inventario::orderBy('created_at', 'desc')->get();

        foreach($inventarios as $inventario) {
            $createDate = Carbon::parse($inventario->created_at);
            $inventario->format_date = $createDate->format('d-m-Y');
        }
        return view('stock', [
            'inventarios' => $inventarios
        ]);
    }

    public function create_inventario(Request $request) {
        
        $inventario = new Inventario;

        $inventario->producto = $request->input('producto');
        $inventario->referencia = $request->input('referencia');
        $inventario->precio = $request->input('precio');
        $inventario->peso = $request->input('peso');
        $inventario->categoria = $request->input('categoria');
        $inventario->stock = $request->input('stock');

        $inventario->save();

        $inventarios = Inventario::orderBy('created_at', 'desc')->get();

        foreach($inventarios as $inventario) {
            $createDate = Carbon::parse($inventario->created_at);
            $inventario->format_date = $createDate->format('d-m-Y');
        }

        return response()->json(
            array(
                'inventarios' => $inventarios,
                'status' => 'success'
            )
        );
    }

    public function delete_inventario($id) {

        $inventario = Inventario::find($id);

        $inventario->delete();

        $inventarios = Inventario::orderBy('created_at', 'desc')->get();

        foreach($inventarios as $inventario) {
            $createDate = Carbon::parse($inventario->created_at);
            $inventario->format_date = $createDate->format('d-m-Y');
        }

        return response()->json(
            array(
                'inventarios' => $inventarios,
                'status' => 'success'
            )
        );
    }

    public function edit_inventario(Request $request) {

        $inventario = Inventario::where('id', $request->input('id'))->first();
        
        $inventario->producto = $request->input('producto');
        $inventario->referencia = $request->input('referencia');
        $inventario->precio = $request->input('precio');
        $inventario->peso = $request->input('peso');
        $inventario->categoria = $request->input('categoria');
        $inventario->stock = $request->input('stock');

        $inventario->save();

        $inventarios = Inventario::orderBy('created_at', 'desc')->get();

        foreach($inventarios as $inventario) {
            $createDate = Carbon::parse($inventario->created_at);
            $inventario->format_date = $createDate->format('d-m-Y');
        }

        return response()->json(
            array(
                'inventarios' => $inventarios,
                'status' => 'success'
            )
        );
    }

    public function ventas() {
        $inventarios = Inventario::orderBy('created_at', 'desc')->get();

        return view('ventas', [
            'inventarios' => $inventarios
        ]);
    }

    public function search_producto(Request $request) {
        $inventario = Inventario::where('id', $request->input('id'))->first();

        return response()->json(
            array(
                'inventario' => $inventario,
                'status' => 'success'
            )
        );
    }

    public function create_venta(Request $request) {
        
        $venta = new Venta;
        
        $venta->id_producto = $request->input('id');
        $venta->cantidad = $request->input('cantidad');
        
        $venta->save();

        $inventario = Inventario::where('id', $request->input('id'))->first();
        $inventario->stock = $inventario->stock - $venta->cantidad;
        $inventario->save();
        
        return response()->json(
            array(
                'inventario' => $inventario,
                'status' => 'success'
            )
        );
    }
}
