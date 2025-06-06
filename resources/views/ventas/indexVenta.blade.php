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
                             Artículos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                            <li><a href="{{ url('/categorias') }}" class="dropdown-item">Categorías</a></li>
                            <li><a href="{{ url('/articulos') }}" class="dropdown-item">Artículos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/cliente') }}">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/ventas') }}">Comprar Articulo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">{{ strtoupper(session('usuario')) }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
   <div  class="container-fluid  mt-5 gap-4">
    <div class="container-fluid cont-agregar-informacion mt-4 w-50">
        <form action="{{ url('ventas') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="text-center text-white">Comprar Articulos!</h1>
            <div class="row d-flex ">
                <div class="col-md-6 p-1 m-0">
                    <label class="text-white  p-0"  for="cliente">Cliente</label>
                    <input type="text" class="form-control" placeholder="Cliente" id="cliente" name="cliente" required>
                </div>
                <div class="col-md-6 p-1 m-0">
                    <label class="text-white p-0" for="articulo">Articulo</label>
                    <input type="text" class="form-control" placeholder="Articulo" id="articulo"  name="articulo" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 p-1 m-0">
                    <label class="text-white" for="precio">Precio</label>
                    <input type="number" class="form-control" placeholder="Precio" id="precio"  name="precio" required>
                </div>
                <div class="col-md-6 p-1 m-0">
                    <label class="text-white" for="categoria_id">Seleccionar una Categoria</label>
                    <select class="form-control" name="categoria_id" id="categoria_id" required>
                        <option value="">-- Selecciona una opción --</option>
                            <option value="">Banreservas</option>
                            <option value="">Banco Popular</option>
                            <option value="">Banco Adopem</option>
                            <option value="">Banco BHD Leon</option>
                            <option value="">Banco Caribe</option>
                            <option value="">Banco Vimenca</option>
                    </select>
                    {{-- <input type="text" class="form-control" placeholder="Categoria" id="categoria"  name="categoria" required> --}}
                </div>
            </div>
            <div class="row mt-2">
                <label class="text-white p-0" for="foto">Articulo</label>
                <!--Mostrar Articulos-->
                {{-- <img src="{{ asset('storage').'/'.$articulo->foto }}" class="rounded-5" alt="" width="60" height="200"> --}}
            </div>
            <div class="d-grid w-100">
                <button class="btn btn-success" type="submit" >Comprar Articulo</button>
            </div>
        </form>
    </div>
    {{-- <div class="container mt-4 w-75">
        <table class="table table-striped table-active table-bordered custom-table text-center">
            <thead class="table-light">
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Categoria</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($datosArticulos as $articulos)
                <tr>
                    <td>
                        <img src="{{ asset('storage').'/'.$articulos->foto }}" alt="" width="150">
                    </td>
                    <td>{{ $articulos->nombre }}</td>
                    <td>{{ $articulos->precio }}</td>
                    <td>{{ $articulos->descripcion }}</td>
                    <td>{{ $articulos->categoria->nombre ?? 'Categoría no disponible' }}</td>
                    <td>
                        <a href="{{ url('articulos/' . $articulos->id . '/edit') }}" class="btn btn-warning btn-sm">Editar </a>
                        
                        <form action="{{ url('articulos/'.$articulos->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta categoria?')">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
   </div>
    <style>
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Centrar en pantalla completa */
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
            background-color:#FFD700;
            /* background-color:white; */
        }
        .custom-table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 15px;
            overflow: hidden;
        }
        li, li a , a{
            font-family: 'Georgia', serif;
            font-weight: bold;
            font-size: 21px;
        }
        .cont-agregar-informacion{
            max-height: 550px;
            padding: 30px;
            border: white;
            border-radius: 15px;
            box-shadow: rgba(163, 151, 151, 0.664) 0px 54px 55px, rgba(20, 16, 16, 0.918) 0px -12px 30px, rgba(255, 254, 254, 0.856) 0px 4px 6px, rgba(247, 247, 247, 0.17) 0px 12px 13px, rgba(214, 214, 214, 0.09) 0px -3px 5px;
        }
        label{
            margin:10px 0;
        }
        .d-grid .btn{
            margin:25px 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>