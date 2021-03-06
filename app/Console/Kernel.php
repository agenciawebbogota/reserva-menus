<?php

namespace App\Console;
use App\Menu;
use App\User;
use Mail;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // // Inicio de sentencias para el bloqueo de los usuarios al momento de la suscripción, excluimos todos los usuarios SUPERUSUARIOS.
            // $usuarios = User::all()->where('tipo_usuario','!=', 'SUPERUSUARIO');
            // foreach ($usuarios as $usuario) {
            //     // Verificar si el usuario está bloqueado
            //     if($usuario->bloqueado == "SI"){
            //         return 'El usuario está bloqueado';
            //     }else{
            //         $inicio = $usuario->fecha_creacion;
            //         $fin = date("Y/m/d");
            //         // dd($fin);
            //         $dias = $this->diferenciaDias($inicio, $fin);
            //         // Actualización en la base de datos
            //         $nuevosdias = $usuario->dias - 1;
            //         // Controlar que sólo sea actualizado una vez al día, programar en el cliente un reloj que ejecute esta acción a las 10 am
            //         User::where('id', $usuario->id)->update([
            //             'dias' => $nuevosdias,
            //                 ]);
            //         $dias = User::where('id','=', $usuario->id)->first()->dias;
            //         if($dias == 3){
            //             // Notificar a todos los uausarios que le quedan tres días para que su suscripción sea bloqueada.
            //             Mail::send('correos/alcumplir11dias', [
            //             'usuario' => $usuario,
            //             'dias' => $dias,
            //             ], function($msj)
            //             {
            //             $msj->subject('Recordatorio Ménus Fácil');
            //             $msj->to($this->email);
            //             $msj->bcc(['whary11@gmail.com', 'pablomart81@gmail.com']);
            //             });
            //             return 'Se envío correo electrónico informando a la empresa que está llegando a la caducidad de la suscripción., han pasado '.$dias.' días.';
            //         }else if($dias == 2){
            //             Mail::send('correos/alcumplir11dias', [
            //             'usuario' => $usuario,
            //             'dias' => $dias,
            //             ], function($msj)
            //             {
            //             $msj->subject('Recordatorio Ménus Fácil');
            //             $msj->to($this->email);
            //             $msj->bcc(['whary11@gmail.com', 'pablomart81@gmail.com']);
            //             });
            //             return 'Se envío correo electrónico informando a la empresa que está llegando a la caducidad de la suscripción., han pasado '.$dias.' días.';
            //         }else if($dias == 1){
            //             Mail::send('correos/alcumplir11dias', [
            //             'usuario' => $usuario,
            //             'dias' => $dias,
            //             ], function($msj)
            //             {
            //             $msj->subject('Recordatorio Ménus Fácil');
            //             $msj->to($this->email);
            //             $msj->bcc(['whary11@gmail.com', 'pablomart81@gmail.com']);
            //             });
            //             return 'Se envío correo electrónico informando a la empresa que está llegando a la caducidad de la suscripción., han pasado '.$dias.' días.';
            //         }else if($dias == 0){
            //             User::where('id', $usuario->id)->update([
            //             'bloqueado' => 'SI',
            //             'dias' => 0,
            //             ]);
            //         }
            //     }
            // }


            User::where('id', 1)->update([
                            'tipo_usuario' => 'SUPERUSUARIO',
                            'dias' => 50,
                            ]);

            // Definir el horario y zona de ejecución
        })->timezone('America/Bogota')->dailyAt('22:21');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
    // Otras funciones
    public function diferenciaDias($inicio, $fin)
    {
        $inicio = date_format(date_create($inicio), 'Y-m-d');
        $fin = date_format(date_create($fin), 'Y-m-d');
        $date1 = new DateTime($inicio);
        $date2 = new DateTime( $fin);
        $diff = $date1->diff($date2);
        return $diff->days;
    }
}
