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
                        <a class="nav-link" href="{{ url('/cliente') }}">Usuarios</a>
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
    <h1 class="text-white text-center mt-1">Editar Articulos!</h1>
   <div  class="container d-flex gap-4">
    <div class="container cont-agregar-informacion mt-4 w-50">
        <form action="{{ url('articulos/'.$articulo->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') 
            <h2 class="text-center text-white">Editar Articulos</h2>
            <div class="row mt-2">
                <label class="text-white  p-0"  for="nombre">Nombre</label>
                <input type="text" class="form-control" placeholder="Nombre" id="nombre" name="nombre" value="{{ $articulo->nombre }}" required>
            </div>
            <div class="row mt-3">
                <label class="text-white p-0" for="descripcion">Descripción</label>
                <input type="text" class="form-control" placeholder="Descripción" id="descripcion"  name="descripcion" value="{{ $articulo->descripcion }}" required>
            </div>
            <div class="row">
                <div class="col-sm-6 p-1 m-0">
                    <label class="text-white p-0" for="precio">Precio</label>
                    <input type="number" class="form-control" placeholder="Precio" id="precio"  name="precio" value="{{ $articulo->precio }}" required>
                </div>
                <div class="col-sm-6 p-1 m-0">
                    <label class="text-white p-0" for="categoria_id">Seleccionar una Categoria</label>
                    <select class="form-control" name="categoria_id" id="categoria_id" required>
                        <option value="">-- Selecciona una opción --</option>
                        @foreach ($datosCategorias as $categoria )
                            <option value="{{ $categoria->id }}" @if ($articulo->categoria_id == $categoria->id) selected @endif>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    {{-- <input type="text" class="form-control" placeholder="Categoria" id="categoria"  name="categoria" required> --}}
                </div>
            </div>
            <div class="row mt-2">
                <label class="text-white p-0" for="foto">Articulo</label>
                <img src="{{ asset('storage').'/'.$articulo->foto }}" class="rounded-5" alt="" width="100" height="300">
                <input type="file" class="form-control mt-4" id="foto" name="foto">
            </div>
            <div class="d-flex align-item-center mt-4 gap-3 w-100">
                <button class="btn btn-success w-100" type="submit" >Actualizar Articulos</button>
                <a href="{{ route('articulos.index') }}" class="btn btn-secondary w-100">Cancelar</a>
            </div>
        </form>
    </div>
    <div class="container mt-4 w-75">
        <table class="table table-striped table-active table-bordered custom-table text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Descripción</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datosArticulos as $articulos)
                <tr>
                    <td>{{ $articulos->id }}</td>
                    <td>
                        <img src="{{ asset('storage').'/'.$articulos->foto }}" alt="" width="150">
                    </td>
                    <td>{{ $articulos->precio }}</td>
                    <td>{{ $articulos->categoria->nombre ?? 'Categoría no disponible' }}</td>
                    <td>{{ $articulos->descripcion }}</td>
                    <td>{{ $articulos->nombre }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   </div>
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
            /* background-color:#FFD700; */
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
            max-height: 820px;
            padding: 30px;
            border: white;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: rgba(163, 151, 151, 0.664) 0px 54px 55px, rgba(20, 16, 16, 0.918) 0px -12px 30px, rgba(255, 254, 254, 0.856) 0px 4px 6px, rgba(247, 247, 247, 0.17) 0px 12px 13px, rgba(214, 214, 214, 0.09) 0px -3px 5px;
        }
        li, li a , a{
            font-family: 'Georgia', serif;
            font-weight: bold;
            font-size: 21px;
        }
        label{
            margin:10px 0;
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