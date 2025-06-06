<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?v=1" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form action="{{ url('/usuarios/registrar') }}" method="POST">
            @csrf
            {{-- @method('POST') --}}
            <div class="contenedor-principal container rounded-5">
                <h1 class="text-white text-center p-2">Registrar</h1>
                <div class="row p-2 m-0">
                    <label class="text-white p-0" for="nombre">Nombre</label>
                     <input type="text" placeholder="Nombre" class="form-control" name="nombre" id="nombre" value="">
                     <div class="errorNombre p-0" style="margin:5px 0;  color:rgb(255, 187, 0);"></div>
                </div>
                <div class="row p-2 m-0">
                    <label class="text-white p-0" for="correo">Correo</label>
                     <input type="email" placeholder="Correo" class="form-control" name="correo" id="correo" >
                     <div class="errorEmail p-0" style="margin:5px 0; color:rgb(255, 187, 0);"></div>
                </div>
                <div class="row p-2 m-0">
                    <label class="text-white p-0" for="dirrecion">Dirección</label>
                     <input type="text" placeholder="Dirreción" class="form-control" name="dirrecion" id="dirrecion" >
                     <div class="errorDirrecion p-0" style="margin:5px 0; color:rgb(255, 187, 0);"></div>
                </div>
                <div class="row m-0">
                    <div class="col-md-6">
                        <label class="text-white p-0" for="contrasena">Contraseña</label>
                         <input type="password" placeholder="Contraseña" class="form-control" name="contrasena" id="contrasena">
                         <div class="errorConstrasena p-0" style="margin:5px 0; color:rgb(255, 187, 0);"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-white p-0" for="confirmarContrasena">Confirmar Contraseña</label>
                         <input type="password" placeholder="Confirmar Contraseña" class="form-control" name="confirmarContrasena" id="confirmarContrasena" value="">
                         <div class="errorConfirmarContrasena p-0" style="margin:5px 0; color:rgb(255, 187, 0);"></div>
                    </div>
                </div>
                <div class="d-grid mt-4 mb-4">
                 <button class="btn btn-primary" id="btnRegistrar" type="submit">Registrar</button>
                </div>
                <div class="cont-registrar d-flex justify-content-end align-item-center">
                     <a href="{{ url('/usuarios') }}">Volver a Inicio</a>
                </div>
                <br>
            </div>
        </form>
    </div>
    <script>
      function validarCampo(event){
        const nombre = document.getElementById("nombre");
        const correo = document.getElementById("correo");
        const dirrecion = document.getElementById("dirrecion");
        const contrasena = document.getElementById("contrasena");
        const confirmarContrasena = document.getElementById("confirmarContrasena");
        // Campos de error. 
        const errorNombre = document.getElementsByClassName("errorNombre")[0];
        const errorEmail = document.getElementsByClassName("errorEmail")[0];
        const errorDirrecion = document.getElementsByClassName("errorDirrecion")[0];
        const errorConstrasena = document.getElementsByClassName("errorConstrasena")[0];
        const errorConfirmarContrasena = document.getElementsByClassName("errorConfirmarContrasena")[0];
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
      const btnRegistrar = document.getElementById('btnRegistrar');
      btnRegistrar.addEventListener('click', (event) => {
        validarCampo(event);
      });
    </script>
    <style>
        body{
            /* background-color: rgb(41, 24, 100); */
            background-color: rgb(9, 4, 53);
        }
        .contenedor-principal{
            max-width: 500px;
            justify-content: center;
            align-items: center;
            /* border: 1px solid white; */
            margin-top:8%;
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
