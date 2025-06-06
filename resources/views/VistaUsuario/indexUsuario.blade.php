<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina de inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?v=1" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('usuarios/inicio') }}">Sistema de Ventas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav d-flex justify-content-end w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('usuarios/inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item dropdown text-black">
                        <a class="nav-link dropdown-toggle" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false" role="button" href="#">
                            Administrar Artículos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                            <li><a href="{{ url('/categorias') }}" class="dropdown-item">Categorías</a></li>
                            <li><a href="{{ url('/articulos') }}" class="dropdown-item">Artículos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/obtenerVentas') }}">Pedido</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  id="dropdownSession" data-bs-toggle="dropdown" aria-expanded="false" role="button" href="javascript:void(0)">{{ strtoupper(session('usuario')) }}</a>
                        <ul class="cont-dropdown dropdown-menu" aria-labelledby="dropdownSession">
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <h1 class="text-white text-center mt-3">Lista de Usuarios!</h1>
   <div  class="container d-flex gap-4">
    <div class="container cont-agregar-informacion mt-4 w-50 mb-5">
        <form action="{{ url('cliente') }}" method="POST">
            @csrf
            <h2 class="text-center text-white">Administrar Usuarios</h2>
            <div class="row mb-2">
                <label class="text-white  p-0"  for="nombre">Nombre</label>
                <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre">
                <div class="errorNombre" style="margin:3px 0; color:rgb(255, 187, 0);"></div>
            </div>
            <div class="row mb-2">
                <label class="text-white p-0" for="correo">Correo</label>
                <input type="email" class="form-control" placeholder="Correo" id="correo"  name="correo" >
                <div class="errorCorreo" style="margin:3px 0; color:rgb(255, 187, 0);"></div>
            </div>
            <div class="row mb-2">
                <label class="text-white p-0" for="dirrecion">Direccion</label>
                <input type="text" class="form-control" placeholder="Direccion" id="dirrecion"  name="dirrecion" >
                <div class="errorDireccion" style="margin:3px 0; color:rgb(255, 187, 0);"></div>
            </div>
            <div class="row">
                <label class="text-white p-0" for="role">Roles</label>
                <select class="form-control" name="role" id="role">
                    <option value="">Role</option>
                    <option value="admin">Administrador</option>
                    <option value="user">Usuario</option>
                </select>
                <div class="errorRole" style="margin:3px 0; color:rgb(255, 187, 0);"></div>
            </div>
            <div class="row">
                <div class="col-md-6 p-1">
                    <label class="text-white form-label" for="contrasena">Contraseña</label>
                    <input type="password" class="form-control w-100" placeholder="Contraseña" id="contrasena"  name="contrasena" >
                    <div class="errorContrasena" style="margin:3px 0; color:rgb(255, 187, 0);"></div>
                </div>
                <div class="col-md-6 p-1">
                    <label class="text-white form-label" for="confirmarContrasena">Confirmar Contraseña</label>
                    <input type="password" class="form-control w-100" placeholder="Confirmar Contraseña" id="confirmarContrasena" >
                    <div class="errorConfirmarContrasena" style="margin:3px 0; color:rgb(255, 187, 0);"></div>
                </div>
            </div>
            <div class="row mt-4" >
                <button class="btn btn-success w-100" id="btnAgregarUsuario" type="submit" >Agregar Usuario</button>
                <a href="{{ route('usuarios.inicio') }}" class="btn btn-outline-secondary mt-3 text-white">Volver a Inicio</a>
            </div>
        </form>
    </div>
    <div class="container mt-4 w-75">
        <table class="table table-striped table-active table-bordered custom-table text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Role</th>
                    <th>Direccion</th>
                    <th>Correo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datosUsuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->role }}</td>
                    <td>{{ $usuario->dirrecion }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td>{{ $usuario->fecha }}</td>
                    <td>
                        <a href="{{ url('cliente/' . $usuario->id . '/edit') }}" class="btn btn-warning btn-sm">Editar </a>
                        
                        <form action="{{ url('cliente/'.$usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   </div>
   <script>
    function validarCampo(event){
        const nombre = document.getElementById("nombre");
        const correo = document.getElementById("correo");
        const dirrecion = document.getElementById("dirrecion");
        const contrasena = document.getElementById("contrasena");
        const confirmarContrasena = document.getElementById("confirmarContrasena");
        const role = document.getElementById('role');
        // Campos de error. 
        const errorNombre = document.getElementsByClassName("errorNombre")[0];
        const errorEmail = document.getElementsByClassName("errorCorreo")[0];
        const errorDirrecion = document.getElementsByClassName("errorDireccion")[0];
        const errorConstrasena = document.getElementsByClassName("errorContrasena")[0];
        const errorConfirmarContrasena = document.getElementsByClassName("errorConfirmarContrasena")[0];
        const errorRole = document.getElementsByClassName('errorRole')[0];
        errorNombre.textContent = "";
        errorEmail.textContent = "";
        errorDirrecion.textContent = "";
        errorConstrasena.textContent = "";
        errorConfirmarContrasena.textContent = "";
        let esValido = true;
        let primerError = null;
        if(nombre.value.trim() === ""){
            errorNombre.textContent = "Por favor, Ingresar un nombre";
            if(!primerError) primerError = nombre;
            esValido = false;
        }
        if(correo.value.trim() === ""){
            errorEmail.textContent = "Por favor, Ingresar un correo";
            if(!primerError) primerError = correo;
            esValido = false;
        }
        if(dirrecion.value.trim() === ""){
            errorDirrecion.textContent = "Por favor, Ingresar un dirección";
            if(!primerError) primerError = dirrecion;
            esValido = false;
        }
        if(role.value === ""){
            errorRole.textContent = "Por favor, Seleccionar un Role";
            if(!primerError) primerError = role;
            esValido = false;
        }
        if(contrasena.value.trim() === ""){
            errorConstrasena.textContent = "Por favor, Ingresar un contraseña";
            if(!primerError) primerError = contrasena;
            esValido = false;
        }
        if(confirmarContrasena.value.trim() === ""){
            errorConfirmarContrasena.textContent = "Por favor, Ingresar una confirmacion de contraseña";
            if(!primerError) primerError = confirmarContrasena;
            esValido = false;
        }
        if( contrasena.value !== confirmarContrasena.value){
            errorConfirmarContrasena.textContent = "Las contraseña no coinciden";
            if(!primerError) primerError = confirmarContrasena;
            esValido = false;
        }
        if(!esValido){
            if(primerError){
                primerError.focus();
                event.preventDefault();
            }
        }
      }
      const btnAgregarUsuario = document.getElementById('btnAgregarUsuario');
      btnAgregarUsuario.addEventListener('click', (event) => {
        validarCampo(event);
      });
   </script>
    <style>
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        body{
            background-color: rgb(9, 4, 53);
            /* background-color: black; */
        }
        .navbar-brand, .nav-link{
            color: black;
            font-weight: 500;
        }
        .navbar-brand:hover, .nav-link:hover{
            color: black;
            font-weight: 500;
        }
        nav{
            background-color:#ffcc00;
            /* background-color:white; */
        }
        .custom-table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 15px;
            overflow: hidden;
        }
        .cont-agregar-informacion{
            height: auto;
            padding: 30px;
            border: white;
            border-radius: 20px;
            box-shadow: rgba(163, 151, 151, 0.664) 0px 54px 55px, rgba(20, 16, 16, 0.918) 0px -12px 30px, rgba(255, 254, 254, 0.856) 0px 4px 6px, rgba(247, 247, 247, 0.17) 0px 12px 13px, rgba(214, 214, 214, 0.09) 0px -3px 5px;
        }
        label{
            margin:10px 0;
        }
        li, li a , a{
            font-family: 'Georgia', serif;
            font-weight: bold;
            font-size: 21px;
        }
        .nav-item .cont-dropdown {
            left: -13px;
            margin: auto;
        }
        .d-grid .btn{
            margin:25px 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>