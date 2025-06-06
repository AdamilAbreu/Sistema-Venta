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
    
    <h1 class="text-white text-center mt-3">Lista de Ventas!</h1>
   <div  class="container">
    <div class="container mt-4 w-75">
        <table class="table table-striped table-active table-bordered custom-table text-center">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nombre Pedido</th>
                    <th>Cliente</th>
                    <th>Metodo Pago</th>
                    <th>Estado</th>
                    <th>Fecha Pedido</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datosPedido as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->articulo->nombre }}</td>
                    <td>{{ $pedido->usuario->nombre }}</td>
                    <td>{{ $pedido->metodo_pago }}</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>{{ $pedido->fecha_pedido }}</td>
                    <td>{{ $pedido->cantidad }}</td>
                    <td>{{ $pedido->total }}</td>
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
        li, li a , a{
            font-family: 'Georgia', serif;
            font-weight: bold;
            font-size: 21px;
        }
        .custom-table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 15px;
            overflow: hidden;
        }
        .cont-agregar-informacion{
            max-height: 360px;
            padding: 30px;
            border: white;
            border-radius: 15px;
            box-shadow: rgba(163, 151, 151, 0.664) 0px 54px 55px, rgba(20, 16, 16, 0.918) 0px -12px 30px, rgba(255, 254, 254, 0.856) 0px 4px 6px, rgba(247, 247, 247, 0.17) 0px 12px 13px, rgba(214, 214, 214, 0.09) 0px -3px 5px;
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