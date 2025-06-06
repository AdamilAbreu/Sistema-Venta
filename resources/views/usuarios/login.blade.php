<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?v=1" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form action="{{ url('/usuarios/login') }}" method="POST">
            @csrf
            {{-- @method('POST') --}}
            @if ($errors->has('login'))
                <p style="color: red;">{{ $errors->first('login') }}</p>
            @endif
            <div class="contenedor-principal container rounded-5">
            <h1 class="text-white text-center p-2 mt-3">Iniciar sesión</h1>
            <div class="row p-2 m-0">
                <label class="text-white p-0" for="nombre">{{ 'Nombre' }}</label>
                <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" value="" >
                <div class="errorNombre" style="margin:5px 0;  color:rgb(255, 187, 0);"></div>
            </div>
            <div class="row p-2 m-0">
                <label class="text-white p-0" for="contrasena">{{ 'Contraseña' }}</label>
                <input type="password" class="form-control " placeholder="Contraseña" name="contrasena" id="contrasena" value="">
                <div class="errorContrasena" style="margin:5px 0;  color:rgb(255, 187, 0);"></div>
            </div>
            <div class="d-grid mt-4 mb-4">
                <button  class="btn btn-primary" id="btnIniciarSesion" type="submit">Iniciar sesion</button>
            </div>
            <div class="cont-registrar d-flex justify-content-end align-item-center">
                <a  href="{{ url('/usuarios/create') }}">Registrarse</a>      
            </div>
            <br>
        </form>
    </div>
    
<!-- Modal -->
<div id="errorModal" class="modal fade show" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error de inicio de sesión</h5>
            </div>
            <div class="modal-body">
                <p>{{ session('error') }}</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="closeModalError(); return false;" id="btnVolver">Volver</button>
            </div>
            </div>
        </div>
    </div>
<script>
    
    //   let errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    //     errorModal.show();
    //     // Cerrar automáticamente después de 4 segundos (4000 ms)
    //     setTimeout(function() {
    //         errorModal.hide();
    //     }, 4000);
        function closeModalError(){
            document.getElementById('errorModal').style.display = 'none';
        }
        const btnIniciarSesion = document.getElementById('btnIniciarSesion');
        btnIniciarSesion.addEventListener('click', (event) => {
            validarCampo(event);
        });

        function validarCampo(event){
            const nombre = document.getElementById('nombre');
            const contrasena = document.getElementById('contrasena');
            const errorNombre = document.getElementsByClassName('errorNombre')[0];
            const errorContrasena = document.getElementsByClassName('errorContrasena')[0];
            errorNombre.textContent = "";
            errorContrasena.textContent = "";
            let esValido = true;
            let primerError = null;

            if(nombre.value.trim() === ""){
                
                errorNombre.textContent = "Por favor, Ingresar un nombre";
                if(!primerError) primerError = nombre;
                esValido = false;
            }
            if(contrasena.value.trim() === ""){
                errorContrasena.textContent = "Por favor, Ingresar una contraseña";
                if(!primerError) primerError = contrasena;
                esValido = false;
            }
            if(!esValido){
                primerError.focus();
                event.preventDefault();
            }
        };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body{
            /* background-color: rgb(41, 24, 100); */
            /* background-color: rgb(24, 3, 34); */
            background-color: rgb(9, 4, 53);
        }
        .contenedor-principal{
            max-width: 500px;
            justify-content: center;
            align-items: center;
            /* border: 1px solid white; */
            margin-top:10%;
            box-shadow: rgba(255, 255, 255, 0.25) 0px 54px 55px, rgba(245, 241, 241, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(247, 247, 247, 0.17) 0px 12px 13px, rgba(214, 214, 214, 0.09) 0px -3px 5px;
        }
        h1{
            font-family: 'Georgia', serif;
        }
        label{
            margin:10px 0;
            font-size:17px;
        }
        a{
            text-decoration: none;
            color: white;
            font-size: 20px;
            margin:0 10px;
        }
        .btn-primary{
            margin:0 10px;
        }
    </style>
</body>
</html>