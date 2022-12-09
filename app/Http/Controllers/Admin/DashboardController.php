<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Compras;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = Productos::all();
        $msj = "";
        if (count($producto) > 0) {
            $producto = $this->precioIva($producto);
        }        
        return view('admin.home', compact('producto', 'msj'));
    }
    public function precioIva($data) {
        $i = 0;
        $c = [];
        foreach ($data as $value) {
            $c[$i]['id'] = $value->id;
            $c[$i]['name'] = $value->name;
            $precio_conIva = $value->precio + ($value->impuesto * ($value->precio / 100));
            $c[$i]['precio'] = $precio_conIva;
            $c[$i]['impuesto'] = $value->impuesto;
            $i++;
        }
        return $c;
    }


    public function comprar(Request $request)
    {
        $user_id = Auth::User()->id;
        $count = count($request->producto_id);
        $productos = $request->producto_id;
        for ($i=0; $i < $count; $i++) { 
            $r = [
                'user_id' => $user_id,
                'producto_id' => $productos[$i]
            ];            
            Compras::create($r);            
        }
        
        $producto = Productos::all();
        $msj = "Compra exitosa";
        return view('admin.home', compact('producto', 'msj'));
    }
    public function facturaDesgloce($id = 0) {       
        if ($id != 0) {
            $compras = DB::table('compras')
                        ->select('user_id','producto_id', DB::raw('count(*) as cantidad_producto'))
                        ->where('user_id', $id)
                        ->groupBy('producto_id')
                        ->groupBy('user_id')
                        ->get();                                            
        } else {
            $compras = DB::table('compras')
                        ->select('user_id','producto_id', DB::raw('count(*) as cantidad_producto'))
                        ->groupBy('producto_id')
                        ->groupBy('user_id')
                        ->get();
        }
        $c = [];
        if (count($compras) > 0) {            
            $i = 0;
            foreach ($compras as $value) {
                $producto = Productos::where("id", $value->producto_id)->first();
                $c[$i]['user_id'] = $value->user_id;
                $c[$i]['producto_id'] = $value->producto_id;
                $c[$i]['name'] = "";
                $c[$i]['precio'] = 0;
                $c[$i]['impuesto'] = 0;
                $c[$i]['cantidad_producto'] = $value->cantidad_producto;
                $c[$i]['precio_total_producto'] = 0;                
                $c[$i]['impuesto_total_producto'] = 0;
                if ($producto != null) {
                    $c[$i]['name'] = $producto->name;
                    $c[$i]['precio'] = $producto->precio;
                    $c[$i]['impuesto'] = $producto->impuesto;                    
                    $precio_sinIva = ($value->cantidad_producto * $producto->precio);
                    $c[$i]['precio_total_producto'] = $precio_sinIva;
                    $precio_conIva = $precio_sinIva + ($producto->impuesto * ($precio_sinIva / 100));
                    $c[$i]['impuesto_total_producto'] = $precio_conIva;
                }
                $i++;
            }     
            $c = $this->agrupar($c);       
        }
        return $c;
    }

    public function agrupar($c) {
        $groupedArray = array();
        $k = array();
        foreach($c as $key => $valuesAry){
            $user_id = $valuesAry['user_id'];
            if(!in_array($user_id, $k)){
                $k[] = $user_id;
            }
            $index = array_search($user_id, $k);
            $groupedArray[$index][] = $valuesAry;
        }
        return $groupedArray;
    }

    public function facturaTotal() {
        $c = $this->facturaDesgloce();  
        $t = [];
        if(count($c) > 0) {      
            for ($i=0; $i < count($c); $i++) { 
                $cantidad_producto = 0;
                $precio_total_producto = 0;
                $impuesto_total_producto = 0;                
                foreach ($c[$i] as $value) {
                    $user = User::where("id", $value['user_id'])->first();
                    $t[$i]['cliente'] = $user->name;
                    $t[$i]['user_id'] = $value['user_id'];
                    $cantidad_producto = $cantidad_producto + $value['cantidad_producto'];
                    $t[$i]['cantidad_producto'] = $cantidad_producto;
                    $precio_total_producto = $precio_total_producto + $value['precio_total_producto'];
                    $t[$i]['precio_total_producto'] = $precio_total_producto; 
                    $impuesto_total_producto = $impuesto_total_producto + $value['impuesto_total_producto'];
                    $t[$i]['impuesto_total_producto'] = $impuesto_total_producto;                    
                }
            }            
        }
        // dd($t);
        return $t;
    }

    public function indexAdmin()
    {
        $producto = Productos::orderBy('id', 'desc')->get();
        return view('admin.listP', compact('producto'));
    }

    public function form($id = 0)
    {
        if ($id == 0) {
            return view('admin.form');
        } else {
            $producto = Productos::where('id', $id)->first();
            return view('admin.form',compact('producto'));
        }        
    }

    public function crear(Request $request)
    {
        if ($request->id == 0) {
            $r = [
                "name" => $request->name,
                "precio" => $request->precio,
                "impuesto" => $request->impuesto
            ];
            Productos::create($r);
        } else {
            $r = [
                "name" => $request->name,
                "precio" => $request->precio,
                "impuesto" => $request->impuesto
            ];
            Productos::where('id', $request->id)->update($r);
        }

        return redirect('admin/producto');
    }

    public function destroy($id)
    {
        Productos::where('id', $id)->delete();
        Compras::where('user_id', $id)->delete();
        return redirect('admin/producto');
    }

    public function createPDF(){
        $productos = $this->facturaTotal();
        return PDF::loadView('admin/pdf', compact('productos'))->stream('archivo.pdf');
    }

    public function factura()
    {
        $producto = $this->facturaTotal();
        return view('admin.factura',compact('producto')); 
    }

    public function createPDFD($id)
    {
        $producto = $this->facturaDesgloce($id);
        $user_id = $producto[0][1]["user_id"];
        $productos = $producto[0];
        $c = User::where('id',$user_id)->first();
        $cliente = $c->name;
        return PDF::loadView('admin/pdfd', compact('productos','cliente'))->stream('archivo.pdf'); 
    }
}
