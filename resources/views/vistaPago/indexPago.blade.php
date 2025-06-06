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
            <a class="navbar-brand" href="{{ url('usuarios/inicio') }}">Sistema de Ventas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav d-flex justify-content-end w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Productos</a>
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
    <h1 class="text-white text-center mt-4">Resumen de tu Compra</h1>
   <div  class="container d-flex gap-4">
    <div class="container cont-agregar-informacion mt-4 w-50">
        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf
            {{-- @method('POST') --}}
            <h2 class="text-center text-white">Administrar Pago</h2>
            <div class="row mt-3">
                <label class="text-white p-0" for="numeroPago"># Numero Tajeta</label>
                <input type="number" class="form-control required" placeholder="# Numero Tajeta" id="numeroPago"  name="numeroPago" value="" required>
                <div class="errorNumero"></div>
            </div>
            <div class="d-grid">
                {{-- <a href="{{ route('articulos.index') }}" onclick="limpiarCompra()" class="btn btn-secondary w-100">Cancelar</a> --}}
                <button type="submit" onclick="limpiarCompra()" class="btn btn-secondary w-100">Cancelar</button>
            </div>
        </form>
    </div>
    <div class="container mt-5">
        <table class="table table-striped table-active table-bordered custom-table text-center">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="carrito-lista"></tbody>
        </table>
        <h4 class="text-white mt-3">Total a Pagar: $<span id="total-compra">0.00</span></h4>
        {{-- <form action="{{ route('') }}" method="POST">
            @csrf
        </form> --}}
        <form id="formularioCompra" action="{{ route('pedidos.store') }}" method="POST" onsubmit="enviarCarrito()">
            @csrf
            <input type="hidden" name="carrito" id="carrito-input">
            <button class="btn btn-success mt-3" type="submit">Finalizar Compra</button>
        </form>
    </div>
 <script>
    function cargarCarrito() {
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        let tbody = document.getElementById('carrito-lista');
        let total = 0;
        
        tbody.innerHTML = "";
        carrito.forEach(item => {
            let subtotal = item.precio * item.cantidad;
            total += subtotal;
            tbody.innerHTML += `
                <tr>
                    <td>${item.nombre}</td>
                    <td>$${item.precio}</td>
                    <td>${item.cantidad}</td>
                    <td>$${subtotal}</td>
                </tr>
            `;
        });
        document.getElementById('total-compra').textContent = total.toFixed(2);
    }

    document.querySelector("form").addEventListener("submit", function(event) {
        var metodoPago = document.getElementById("metodo_pago").value;
        if (metodoPago === "") {
            event.preventDefault();  // Evita que el formulario se envíe
            alert("Por favor, seleccione un método de pago.");
        }
    });
    function enviarCarrito() {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    document.getElementById('carrito-input').value = JSON.stringify(carrito); 
}
    function limpiarCompra() {
        // Vaciar carrito después de la compra
        localStorage.removeItem('carrito'); 
        window.location.href = "{{ route('articulos.index') }}"; 
    }
    function validarNumero(){
        const numeroPago = document.getElementById('numeroPago');
        const valor = numeroPago.value.trim(); 
        const regex = /^\d{11}$/;
        if (!regex.test(valor)) {
            alert("El número de tarjeta debe contener exactamente 11 dígitos numéricos.");
            numeroPago.value = ""; 
            numeroPago.focus();
            return false; 
        }
        return true; 
    }
    window.onload = cargarCarrito;
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
            left: -75px;
            margin: auto;
        }
        .d-grid .btn{
            margin:25px 0;
        }
        .cont-agregar-informacion{
            max-height: 10%;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 
 
 
