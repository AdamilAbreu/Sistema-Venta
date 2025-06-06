<?php

namespace App\Http\Controllers;

use App\Models\Articulos;
use App\Models\pedido;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Usuario;
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('vistaPago.indexPago');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datosPedido = $request->input('carrito'); 
        $datosPedido = json_decode($request->input('carrito'), true); // Decodificar el JSON del carrito
        $direccion = $request->input('direcion_envio'); 
        $metodoPago = $request->input('metodo_pago');
        if ($datosPedido) {
            foreach ($datosPedido as $item) {
                // Verificar que los campos requeridos estén presentes
                if (!isset($item['usuario_id'], $item['id'], $item['cantidad'], $item['total'], $item['estado'])) {
                    return redirect()->route('articulos.index')->with('error', 'Faltan datos en el carrito');
                }
                pedido::create([
                    'usuario_id' => (int)$item['usuario_id'],
                    'articulo_id' => (int)$item['articulo_id'],
                    'cantidad' => (int)$item['cantidad'],
                    'total' => (float)$item['total'],
                    'fecha_pedido' => now(),
                    'estado' => $item['estado'],
                    'direcion_envio' => 'null',  
                    'metodo_pago' => 'Tarjetas de débito y crédito',  
                ]);
            }
            return redirect()->route('articulos.index');
        }
        return redirect()->route('pedidos.index')->with('error', 'No se enviaron datos del carrito');
    }
    /**
     * Display the specified resource.
     */
    public function show(pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pedido $pedido)
    {
        //
    }

    public function obtenerVentas(Request $request){
         // Verificar si el usuario es admin
         if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        $datosPedido = Pedido::with(['articulo', 'usuario'])->get();
        return view('pedido', compact('datosPedido')); 
    }
}
