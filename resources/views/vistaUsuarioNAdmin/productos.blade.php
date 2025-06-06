<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina de inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?v=1" rel="stylesheet">
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
                        <a class="nav-link" href="javascript:void(0)">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cantidadCarrito" href="{{ url('/pedidos') }}">
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
            <input type="hidden" id="usuarioId" value="{{ session('id') }}">
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-white mb-4">Listas de Productos</h2>
        <div class="row">
            @foreach($datosArticulos as $articulo)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 100%">
                        <img class="card-img-top img-fluid" src="{{ asset('storage/' . $articulo->foto) }}" alt="Imagen del artículo">
                        <div class="card-body">
                            <h4 class="card-title">{{ $articulo->nombre }}</h4>
                            <p class="card-text">{{ $articulo->descripcion }}</p>
                            <p class="precio card-text">${{ $articulo->precio }}</p>

                            <input type="number" id="cantidad-{{ $articulo->id }}" value="1" min="1" class="form-control mb-3" style="max-width: 100px;">
                            <div class="d-grid">
                               <button class="btn btn-primary agregarCarrito"
                               data-id="{{ $articulo->id }}"
                               data-nombre="{{ $articulo->nombre }}"
                               data-precio="{{ $articulo->precio }}"
                               >Agregar Al Carrito
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
       // Variable global para llevar el contador del carrito
let carritoCantidad = 0;
// Función para obtener la fecha actual en formato YYYY-MM-DD
function obtenerFechaActual() {
    const hoy = new Date();
    // Formato: YYYY-MM-DD
    return hoy.toISOString().split('T')[0]; 
}
document.querySelectorAll('.agregarCarrito').forEach(button => {
    button.addEventListener('click', function() {
        // Convertir id a número
        const id = parseInt(this.dataset.id); 
        const nombre = this.dataset.nombre;
        // Asegurar que el precio sea un número
        const precio = parseFloat(this.dataset.precio); 
        // Obtener cantidad ingresada
        const cantidad = parseInt(document.getElementById('cantidad-' + id).value); 
        const fecha_pedido = obtenerFechaActual();
        const estado = "Comprado";
        // const usuario_id = @json(session('id'));
        const usuario_id = document.getElementById('usuarioId').value;
        const articulo_id = id;
         // Calcular el total
        const total = precio * cantidad;

        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        // Verificar si el producto ya está en el carrito
        let index = carrito.findIndex(item => item.id === id);
        if (index !== -1) {
            carrito[index].cantidad += cantidad;
             // Actualizar total
            carrito[index].total += total;
        } else {
            carrito.push({ id, nombre, precio, cantidad, estado, usuario_id, articulo_id, total, fecha_pedido });
        }

        // Guardar en localStorage
        localStorage.setItem('carrito', JSON.stringify(carrito));

        // Recalcular el total de productos en el carrito
        carritoCantidad = carrito.reduce((acc, item) => acc + item.cantidad, 0);
        document.getElementById('contadorCarrito').textContent = carritoCantidad;

        alert('Producto agregado al carrito');
    });
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
        .precio{
            font-size: 20px;
            font-weight: 500;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        li, li a , a{
            font-family: 'Georgia', serif;
            font-weight: bold;
            font-size: 21px;
        }
        .card-img-top {
            width: 100%; 
            height: 150px;
            object-fit: cover; 
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>