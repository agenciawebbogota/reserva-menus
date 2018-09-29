<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | Registro de sucursales</title>
    <!-- Fuentes -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Estilos CSS -->
    <link href="{{ url('registro/css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image:url(/img/bg-register.jpg);background-repeat:no-repeat">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#2b2831">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{url('/admin/img/logo-menusfacil.svg')}}" alt="Menus Facil Logo" width="250px" class="imagen-logo img-circle img-responsive">
                </a>
                <a class="btn btn-info" style="background-color:#e88911;border-color:#e88911" href="{{ url('dashboard') }}">Volver</a>
            </div>
        </nav>
        <br><br><br>
        <div class="container" id="sucursal">
                <pre>@{{ $data }}</pre>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card" style="border:1px solid #2b2831;border-radius:6px">
                            <div class="card-header">Crear Sucursal</div>
                            <div class="card-body">
                                <form>
                                    {{-- @csrf --}}
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Nombre de sucursal</label>
                                        <div class="col-md-6">
                                            <input id="name" @keyup="urlLug()" type="text" v-model="sucursal.nombre" class="form-control" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" v-model="sucursal.email" class="form-control" required>
                                        </div>
                                    </div>
                                    {{-- <input id="url" type="hidden" name="url" v-model="datos.url">
                                    <input id="color1" type="hidden"  name="color1" value="#2a2730">
                                    <input id="color2" type="hidden"  name="color2" value="#66181a">
                                    <input id="color3" type="hidden" name="color3" value="#E88A10"> --}}
            
                                    {{-- Fin --}}
            
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" v-model="sucursal.clave">
                                            <span v-if="noti.clave.length > 1">
                                                <strong class="red-text">@{{noti.clave}}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control clave_confirmacion" @keyup="compararClave()" required v-model="sucursal.clave_confirmacion">
                                            <span v-if="noti.clave_confirmacion.length > 1">
                                                <strong class="red-text">@{{noti.clave_confirmacion}}</strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary" style="background-color:#21b005;border-color:#21b005">
                                                Crear Sucursal
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div>
                          <p style="padding-top:30px;text-align:center;font-size:12px">Menús Fácil necesita tus datos para activar el servicio. Más información en la <a href="#"> política de privacidad</a></p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="{{ url('admin/sucursales/js/app.js') }}" defer></script>
</body>
</html>


