<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;

class SuperusuarioController extends Controller
{
  public $email;
  public function __construct()
  {
      $this->middleware('auth');

  }

  public function index()
  {
    // Conseguimos el objeto
    $usuario=User::where('id', '=', \Auth::id())->first();
    if($usuario->tipo_usuario === 'SUPERUSUARIO'){
      return view('super_usuario.index');
    }else{
      return redirect('/dashboard');
    }
  }

  public function get()
  {
    // Conseguimos el objeto
    $usuario=User::where('id', '=', \Auth::id())->first();
    if($usuario->tipo_usuario === 'SUPERUSUARIO'){
      // Retornar los usuarios
      return User::all()->where('id','!=',  \Auth::id());
    }else{
      return redirect('/dashboard');
    }
  }

  public function actualizardias(){
    $usuario=User::where('id', '=', \Auth::id())->first();
    if($usuario->tipo_usuario === 'SUPERUSUARIO'){


      // Inicio de sentencias para el bloqueo de los usuarios al momento de la suscripción.
          $user_id = \Auth::id();
          $usuarios = \App\User::where('id','!=', $user_id)->get();

          foreach ($usuarios as $usuario) {
            // Verificar si el usuario está bloqueado
            if($usuario->bloqueado == "SI"){
              return 'El usuario está bloqueado';
            }else{

            $inicio = $usuario->created_at;
            $fin = date("Y/m/d");
            $dias = $this->diferenciaDias($inicio, $fin);
            // Actualización en la base de datos
            User::where('id', $usuario->id)->update([
              'dias' => $dias,
      			]);
            if($dias > 0){
              if($dias == 13 || $dias == 11){
                if($usuario->estado_empresa == "GRATIS"){
                    // Envio de email
                    $this->email = $usuario->email;
                    $ruta = 'correos/alcumplir11dias';
                    if($dias == 13){
                      $ruta = 'correos/alcumplir13dias';
                    }
                    Mail::send($ruta, [
                      'usuario' => $usuario,
                      'dias' => 14 - $dias,
                    ], function($msj)
                    {
                      $msj->subject('Recordatorio Ménus Fácil');
                      $msj->to($this->email);
                      $msj->bcc(['whary11@gmail.com', 'pablomart81@gmail.com']);
                    });
                  return 'Enviar correo electrónico informando a la empresa que está llegando a la caducidad de la suscripción de prueba., han pasado '.$dias.' días.';

                }else{
                  return 'Almacenar en la base de datos el número de días, es un usuario que ya está pagando., han pasado '.$dias.' días.';

                }
              }else if($dias > 13 and $usuario->estado_empresa == "GRATIS"){
                if($usuario->bloqueado == 'NO'){
                  User::where('id', $usuario->id)->update([
                    'bloqueado' => 'SI',
            			]);
                  return 'Bloquear usuario, cambiar el valor de la columna bloqueado a "SI", han pasado '.$dias.' días.';
                }
              }else if($dias == 27 || $dias == 29){
                if($usuario->estado_empresa == "PAGO"){
                  $this->email = $usuario->email;
                  $ruta = 'correos/alcumplir27dias';
                  if($dias == 29){
                    $ruta = 'correos/alcumplir29dias';
                  }
                  Mail::send($ruta, [
                    'usuario' => $usuario,
                    'dias' => 30 - $dias,
                  ], function($msj)
                  {
                    $msj->subject('Recordatorio Ménus Fácil');
                    $msj->to($this->email);
                    $msj->bcc(['whary11@gmail.com', 'pablomart81@gmail.com']);
                  });
                }

                return 'Enviar correo electrónico informando a la empresa que el día siguiente se termina la suscripción de pago., han pasado '.$dias.' días.';
              }else{
                return 'Almacenar en la base de datos el número de días, han pasado '.$dias. ' días';
              }
            }
          }
        }

        // FIn de sentencias para el bloqueo de los usuarios al momento de la suscripción, sólo pasar estas instrucciones en donde se quieren ejecutar y tomar las acciones indicadas en los echos

    }else{
      return redirect('/dashboard');
    }
  }

  public function updateUser(Request $request){
    $usuario = User::where('id', $request->input('id'))->update([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'url' => $request->input('url'),
      'color1' => $request->input('color1'),
      'color2' => $request->input('color2'),
      'color3' => $request->input('color3'),
      'estado_empresa' => $request->input('estado_empresa'),
      'bloqueado' => $request->input('bloqueado'),
      'dias' => $request->input('dias'),
    ]);
    return $usuario;
  }

  public function diferenciaDias($inicio, $fin)
  {
    $datetime1 = $inicio;
    $datetime2 = date_create($fin);
    $interval = date_diff($datetime1, $datetime2);
    return($interval->days);
  }
}