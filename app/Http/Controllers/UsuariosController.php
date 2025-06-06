<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('usuarios.login');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('usuarios.registrar');
    }
    public function login(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'contrasena' => 'required|string'
        ]);
            // Buscar usuario por nombre
    $usuario = Usuarios::where('nombre', $request->nombre)->first();

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
             // Guardar en sesión
             session([
                'usuario' => $usuario->nombre,
                'role' => $usuario->role,
                'id' => $usuario->id
            ]);
            // Redirigir segun el rol
            if($usuario->role === 'admin'){
                return view('usuarios.inicio');
            }else{
                return view('vistaUsuarioNAdmin.indexNoAdmin');
            }
        } else {
            return back()->with(['error' => 'Nombre o contraseña incorrectos']);
        }
    }
    public function inicio(){
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
        
    }
    public function registrar(Request $request){
        // Obtener los datos excepto el token CSRF
        $datosUsuarios = request()->except('_token');
        // Hashear la contraseña antes de guardarla
        $datosUsuarios['contrasena'] = bcrypt($datosUsuarios['contrasena']);
        $datosUsuarios['fecha'] = now();
        // Crear el usuario en la base de datos
        Usuarios::create($datosUsuarios);
        return redirect()->route('usuarios.index')->with('mensaje', 'Usuario registrado correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Usuarios $usuarios)
    {
        // Verificar si el usuario es admin
        if (session('role') !== 'admin') {
            return view('usuarios.login');
        }
        return view('usuarios.inicio');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
