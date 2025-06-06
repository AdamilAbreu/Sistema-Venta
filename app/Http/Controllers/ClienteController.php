<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
        $datosUsuarios = Usuarios::all();
        return view('VistaUsuario.indexUsuario', compact('datosUsuarios')); 
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
        // Verificar si el usuario es admin
        if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        //Almacenar toda la informacion que se envie al metodo store
        // $datosCategoria=$request->all();
        $datosUsuarios=request()->except('_token');
         // Hashear contraseña
        $datosUsuarios['contrasena'] = bcrypt($datosUsuarios['contrasena']);
        $datosUsuarios['fecha'] = now();
        //Almacenar la informacion a la base de datos
        Usuarios::create($datosUsuarios);
        return redirect()->route('VistaUsuario.indexUsuario');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
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
        $usuario  = Usuarios::find($id);
         // Obtener todas las categorías para la tabla
        $datosUsuarios = Usuarios::all();
        if (!$usuario ) {
            return redirect()->route('VistaUsuario.indexUsuario')->with('error', 'Usuario no encontrado.');
        }
        return view('VistaUsuario.editarUsuario', compact('usuario', 'datosUsuarios'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // Verificar si el usuario es admin
        if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        $datosUsuarios = Usuarios::findOrFail($id);
        $datosUsuarios['fecha'] = now();
        // Valida y actualiza la informacion
        $datosUsuarios->update($request->all());
        return redirect()->route('VistaUsuario.indexUsuario');
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
        $datosUsuarios= Usuarios::findOrFail($id);
        $datosUsuarios->delete();
        return redirect()->route('VistaUsuario.indexUsuario'); 
    }
    public function mostrarDatos(){
       
    }
}
