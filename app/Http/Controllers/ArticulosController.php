<?php

namespace App\Http\Controllers;

use App\Models\Articulos;
use App\Models\categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Verificar si el usuario es admin
        if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        $datosArticulos = Articulos::all();
        $datosCategorias = categorias::all();
        return view('administrarArticulos.Articulos.articulos', compact('datosArticulos', 'datosCategorias')); 
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    // public function Inicio(){
    //     return view('usuarios.inicio');
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Verificar si el usuario es admin
        if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        //Almacenar toda la informacion que se envie al metodo store
        $datosArticulos=request()->except('_token');
        if($request->hasFile('foto')){
            $datosArticulos['foto']=$request->file('foto')->store('uploads', 'public');
        }
        //Almacenar la informacion a la base de datos
        Articulos::create($datosArticulos);
        return redirect()->route('articulos.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Articulos $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         // Verificar si el usuario es admin
         if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        // Busca el articulo por su ID
        $articulo  = Articulos::find($id);
        // Obtener todas las categorías para la tabla
        $datosArticulos = Articulos::all(); 
        $datosCategorias = categorias::all();
        if (!$articulo ) {
            return redirect()->route('articulos.index')->with('error', 'Articulo no encontrada.');
        }
        return view('administrarArticulos.Articulos.editarArticulos', compact('articulo', 'datosArticulos', 'datosCategorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         // Verificar si el usuario es admin
         if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        $datosArticulos=request()->except(['_token', '_method']);
        if($request->hasFile('foto')){
            $articulo = Articulos::findOrFail($id);
            //Eliminar la foto anterior
            Storage::delete('public/' .$articulo->foto);
            $datosArticulos['foto']=$request->file('foto')->store('uploads', 'public');
        }
        // Actualizar la información en la base de datos
        Articulos::where('id','=', $id)->update($datosArticulos);
        // Recargar el modelo actualizado
        $articulo = Articulos::findOrFail($id);
        return redirect()->route('articulos.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Verificar si el usuario es admin
         if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        $datosArticulos= Articulos::findOrFail($id);
        $datosArticulos->delete();
        return redirect()->route('articulos.index'); 
    }
    public function mostrarDatos(){
       
    }

    public function obtenerArticulo(){
        $datosArticulos = Articulos::all();
        return view('vistaUsuarioNAdmin.productos',  compact('datosArticulos'));
    }


    public function agregarAlCarrito(Request $request)
    {
        $productoId = $request->input('id');
        $cantidad = $request->input('cantidad', 1); 

        // Obtener el producto desde la base de datos
        $producto = Articulos::find($productoId);

        if ($producto) {
            // Obtener el carrito de la sesión (si no existe, crear uno vacío)
            $carrito = session()->get('carrito', []);

            // Verificar si el producto ya está en el carrito
            $existe = false;
            foreach ($carrito as &$item) {
                if ($item['id'] == $producto->id) {
                    // Si ya existe, solo aumentar la cantidad
                    $item['cantidad'] += $cantidad;
                    $existe = true;
                    break;
                }
            }

            // Si el producto no existe en el carrito, agregarlo
            if (!$existe) {
                $carrito[] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'cantidad' => $cantidad,
                ];
            }

            // Guardar el carrito actualizado en la sesión
            session()->put('carrito', $carrito);

            return response()->json(['message' => 'Producto agregado al carrito']);
        }

        return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    /**
     * Ver el carrito
     */
    public function verCarrito()
    {
        $carrito = session()->get('carrito', []);
        return view('carrito', compact('carrito'));
    }

    /**
     * Vaciar el carrito
     */
    public function vaciarCarrito()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.ver')->with('message', 'El carrito ha sido vaciado');
    }
}
