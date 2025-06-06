<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina de inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?v=1" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-sm navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">Sistema de Ventas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav d-flex justify-content-end w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articulos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/pedidos') }}">
                            <i class="bi bi-cart" style="font-size: 1.2rem;"></i>
                            <span id="contadorCarrito" class="badge " style="color:blue; font-size:17px;">0</span>
                        </a>
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
    
    <h1 class="text-white text-center mt-5">Bienvenido {{ strtoupper(session('usuario')) }}!</h1>
    <div class="logo-container">
        <img src="{{ asset('imagen/logodev.jpeg') }}" class=" rounded-5" alt="Logo">
    </div>
    <style>
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh; 
        }
        body{
            background-color: rgb(9, 4, 53);
            /* background-color: black; */
        }
        .navbar-brand, .nav-link{
            color: rgb(9, 4, 53);
            font-weight: 500;
        }
        .navbar-brand:hover, .nav-link:hover{
            color: rgb(9, 4, 53);
            font-weight: 500;
        }
        nav{
            background-color:#ffcc00;
            /* background-color:white; */
        }
        .nav-item .cont-dropdown {
            left: -75px;
            margin: auto;
        }
        h1{
            font-family: 'Georgia', serif;
        }
        li, li a , a{
            font-family: 'Georgia', serif;
            font-weight: bold;
            font-size: 21px;
        }
        img{
            max-width: 400px;
            box-shadow: rgba(90, 69, 0, 0.932) 0px 30px 30px, rgba(116, 97, 16, 0.932) 0px -12px 30px, rgba(133, 111, 16, 0.932) 0px 4px, rgba(247, 247, 247, 0.17) 0px 12px 13px, rgba(214, 214, 214, 0.09) 0px -3px 5px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>