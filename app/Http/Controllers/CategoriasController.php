<?php

namespace App\Http\Controllers;

use App\Models\categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Verificar si el usuario es admin
         if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        $datosCategoria = categorias::all();
        return view('administrarArticulos.Categorias.categorias', compact('datosCategoria')); 
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function Inicio(){
        // Verificar si el usuario es admin
        if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        return view('usuarios.inicio');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Almacenar toda la informacion que se envie al metodo store
        $datosCategoria=request()->except('_token');
        //Almacenar la informacion a la base de datos
        categorias::create($datosCategoria);
        return redirect()->route('categorias.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(categorias $categorias)
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
        // Busca la categoria por su ID
        $categoria  = categorias::find($id);
        // Obtener todas las categorías para la tabla
        $datosCategoria = categorias::all(); 
        if (!$categoria ) {
            return redirect()->route('categorias.index')->with('error', 'Categoría no encontrada.');
        }
        return view('administrarArticulos.Categorias.editarCategoria', compact('categoria', 'datosCategoria'));
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
        $datosCategoria = categorias::findOrFail($id);
        // Valida y actualiza la informacion
        $datosCategoria->update($request->all());
        return redirect()->route('categorias.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        // Verificar si el usuario es admin
        if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        $datosCategoria= categorias::findOrFail($id);
        $datosCategoria->delete();
        return redirect()->route('categorias.index'); 
    }
    public function mostrarDatos(){
       
    }
}
