<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Pedido;
use App\Menu;
class PedidoController extends Controller
{
	public function getMenusDia(){
    	$menus = Menu::all();
    	return $menus;
    }
    public function getAdicionalesDia(){
    	$adicionales = Menu::all();
    	return $adicionales;
    }
    public function index(){
        $menus = Menu::all();
        // return $menus;
        return view('index',[
            'menus' => $menus,
        ]);
    }
    public function get(){
        $menus = DB::table('pedidos')
            ->where('pedidos.user_id', \Auth::id())
            ->join('menus', 'pedidos.menu_pedido', '=', 'menus.id')
            ->whereDate('pedidos.created_at', '=', Carbon::now()->format('Y-m-d'))
            ->select('pedidos.*', 'menus.nombre as nombre_pedido', 'menus.descripcion', 'menus.precio')
            ->orderBy('created_at', 'ASC')
            ->limit(10)
            ->get();
						$total = 0;
						foreach ($menus as $menu) {
							$total = $menu->precio + $total;
						}
		        return [
							'pedidos' => $menus,
							'total' => $total,
						];
    }
    public function create(Request $request){
        if ($request->input('adicionalPedido') == '') {
            $pedido = Pedido::create([
                'nombre' => $request->input('nombre'),
                'correo' => $request->input('correo'),
                'telefono' => $request->input('telefono'),
                'direccion' => $request->input('direccion'),
                'observaciones' => $request->input('observaciones'),
                'adicional_pedido' => $request->input('adicionalPedido'),
                'menu_pedido'=>$request->input('menuPedido'),
                'user_id' => $request->input('user_id'),
            ]);
            return $pedido;
        }else{
            $pedido = Pedido::create([
                'nombre' => $request->input('nombre'),
                'correo' => $request->input('correo'),
								'telefono' => $request->input('telefono'),
								'direccion' => $request->input('direccion'),
                'observaciones' => $request->input('observaciones'),
                'adicional_pedido' => $request->input('adicionalPedido'),
                'user_id' => $request->input('user_id'),
                'menu_pedido'=>$request->input('menuPedido')
            ]);

        }
            return $pedido;
    }
    public function pdf(){
         $menus = DB::table('pedidos')
            ->where('pedidos.user_id', \Auth::id())
            ->join('menus', 'pedidos.menu_pedido', '=', 'menus.id')
			->whereDate('pedidos.created_at', '=', Carbon::now()->format('Y-m-d'))
            ->select('pedidos.*', 'menus.nombre as nombre_menu', 'menus.descripcion', 'menus.precio')
            ->orderBy('id', 'ASC')
            ->get();
        $adicionales = DB::table('pedidos')
            ->where('pedidos.user_id', \Auth::id())
            ->join('menus', 'pedidos.adicional_pedido', '=', 'menus.id')
			->whereDate('pedidos.created_at', '=', Carbon::now()->format('Y-m-d'))
            ->select('pedidos.*', 'menus.nombre as nombre_adicional', 'menus.descripcion', 'menus.precio')
            ->orderBy('id', 'ASC')
            ->get();
        $view =  \View::make('pdf.pedidos', compact('menus', 'adicionales'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');
        return $pdf->stream('Nombre_Personalizado_PDF');

    }


}
