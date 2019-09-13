<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partida;
use Excel;
use Validator;

class PartidaController extends Controller
{
    // Modo restringido, acceso unicamente a los usuarios registrados mediante el middleware
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $partidas = Partida::orderBy('id','DESC')->get();

        if (request()->ajax()) {
            return datatables()->of(Partida::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<a style="cursor:pointer"name="edit" id="' . $data->id . '"
                    class="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a style="cursor:pointer"name="delete" id="' . $data->id . '"
                    class="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                    $button .= '&nbsp;&nbsp;&nbsp;';
                    $button .= '<a style="cursor:pointer"name="change" id="' . $data->id . '"
                    class="change"><i class="fa fa-exchange" aria-hidden="true"></i></a> ';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('partidas.partidas',[
            'partidas' => $partidas
        ]);
    }

    public function partidaView(){
        return view('partidas.importPartidas');
    }
    public function partidasView(){
        return view('partidas.importPartida');
    }

    public function create(){}

    public function store(Request $request){

        $user = \Auth::user();
        $id = $user->id;
        $date = date("Y-m-d H:i:s");

        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'urg'               => 'required|int|min:4',
            'cuenta'            => 'required|int|min:4',
            'nombre_de_cuenta'  => 'required|string|max:255',
            'enero'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'febrero'           => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'marzo'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'abril'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mayo'              => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'junio'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'julio'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'agosto'            => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'septiembre'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'octubre'           => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'noviembre'         => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'diciembre'         => 'required|regex:/^\d+(\.\d{1,2})?$/'
            
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $acumulado = $request->enero + $request->febrero + $request->marzo + $request->abril + $request->mayo;
        $total = $acumulado + $request->junio + $request->julio + $request->agosto + $request->septiembre
                + $request->octubre + $request->noviembre + $request->diciembre;
        $form_data = array(
            'urg'              => $request->urg,
            'cuenta'           => $request->cuenta,
            'nombre_de_cuenta' => $request->nombre_de_cuenta,
            'enero'            => $request->enero,
            'febrero'          => $request->febrero,
            'marzo'            => $request->marzo,
            'abril'            => $request->abril,
            'mayo'             => $request->mayo,
            'acumulado'        => $acumulado,
            'junio'            => $request->junio,
            'julio'            => $request->julio,
            'agosto'           => $request->agosto,
            'septiembre'       => $request->septiembre,
            'octubre'          => $request->octubre,
            'noviembre'        => $request->noviembre,
            'diciembre'        => $request->diciembre,
            'total'            => $total,
            'created_at'       => $date,
            'user_id'          => $id
        );

        Partida::create($form_data);

        return response()->json(['success' => 'Partida agregada correctamente.']);
    }

    public function show($id){

        return Partida::where('partida_id',$id)->get();

    }

    public function edit($id){
        if (request()->ajax()) {
            $data = Partida::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request){

        $user = \Auth::user();
        $id = $user->id;
        $date = date("Y-m-d H:i:s");

        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'urg'               => 'required|integer|min:4',
            'cuenta'            => 'required|integer|min:4',
            'nombre_de_cuenta'  => 'required|string|max:255',
            'enero'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'febrero'           => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'marzo'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'abril'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mayo'              => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'junio'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'julio'             => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'agosto'            => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'septiembre'        => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'octubre'           => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'noviembre'         => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'diciembre'         => 'required|regex:/^\d+(\.\d{1,2})?$/'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $acumulado = $request->enero + $request->febrero + $request->marzo + $request->abril + $request->mayo;
        $total = $acumulado + $request->junio + $request->julio + $request->agosto + $request->septiembre
                + $request->octubre + $request->noviembre + $request->diciembre;
        $form_data = array(
            'urg'              => $request->urg,
            'cuenta'           => $request->cuenta,
            'nombre_de_cuenta' => $request->nombre_de_cuenta,
            'enero'            => $request->enero,
            'febrero'          => $request->febrero,
            'marzo'            => $request->marzo,
            'abril'            => $request->abril,
            'mayo'             => $request->mayo,
            'acumulado'        => $acumulado,
            'junio'            => $request->junio,
            'julio'            => $request->julio,
            'agosto'           => $request->agosto,
            'septiembre'       => $request->septiembre,
            'octubre'          => $request->octubre,
            'noviembre'        => $request->noviembre,
            'diciembre'        => $request->diciembre,
            'total'            => $total,
            'created_at'       => $date,
            'user_id'          => $id
        );

        Partida::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Provedor actualizado correctamente.']);
    }

    public function destroy($id){

        $data = Partida::findOrFail($id);
        $data->delete();
    }

    public function empty(){
    
        Partida::table('partidas_urg')->delete();

    }

    public function downloadPartida($type){

        $anio = date("Y");
        $data = Partida::get()->toArray();

        return Excel::create('MELPP '.$anio.' CONCENTRADO', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function downloadPlantilla($type){

        $plantilla = array(
            'urg',
            'cuenta',
            'nombre_de_cuenta',
            'enero',
            'febrero',           
            'marzo',             
            'abril',             
            'mayo',              
            'acumulado',         
            'junio',             
            'julio',             
            'agosto',            
            'septiembre',        
            'octubre',           
            'noviembre',         
            'diciembre',         
            'total'             
        );
        return Excel::create('PLANTILLA MELPP CONCENTRADO', function($excel) use ($plantilla) {
            $excel->sheet('mySheet', function($sheet) use ($plantilla)
            {
                $sheet->fromArray($plantilla);
            });
        })->download($type);

    }

    public function importPartida(Request $request){
        $user = \Auth::user();
        $id = $user->id;
        $date = date("Y-m-d H:i:s");

        $request->validate([
            'import_file' => 'required'
        ]);

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
        

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = [
                    'urg'               => $value->urg,
                    'cuenta'            => $value->cuenta,
                    'nombre_de_cuenta'  => $value->nombre_de_cuenta,
                    'enero'             => $value->enero,
                    'febrero'           => $value->febrero,
                    'marzo'             => $value->marzo,
                    'abril'             => $value->abril,
                    'mayo'              => $value->mayo,
                    'acumulado'         => $value->acumulado,
                    'junio'             => $value->junio,
                    'julio'             => $value->julio,
                    'agosto'            => $value->agosto,
                    'septiembre'        => $value->septiembre,
                    'octubre'           => $value->octubre,
                    'noviembre'         => $value->noviembre,
                    'diciembre'         => $value->diciembre,
                    'total'             => $value->total,
                    'user_id'           => $id
                ];
            }

            if(!empty($arr)){
                Partida::insert($arr);
            }else{
                return back()->with('error', 'Compruebe los datos a importar.');        
            }
        }

        return back()->with('success', 'Datos importados correctamente.');
    }

    public function change(Request $request){

        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'partida'   => 'required|integer|min:4',
            'urge'      => 'required|integer|min:4',
            'mes'       => 'required|string|max:255',
            'monto'     => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'destino'   => 'required|integer',
            'mes2'      => 'required|string',
            'monto2'    => 'required|regex:/^\d+(\.\d{1,2})?$/'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $partida   = $request->partida;
        $urge      = $request->urge;
        $mes       = $request->mes;
        $monto     = $request->monto;
        $destino   = $request->destino;
        $mes2      = $request->mes2;
        $monto2    = $request->monto2;

        /*Partida::whereId($request->hidden_id)->update($form_data); */
        Partida::table('partidas_urg')->decrement($mes, $menosmonto)->where('id',$origen);
        Partida::table('partidas_urg')->increment($mes2, $masmonto)->where('id', $destino);

        return response()->json(['success' => 'Transferencia concretada con exito.']);
    }
       
}
