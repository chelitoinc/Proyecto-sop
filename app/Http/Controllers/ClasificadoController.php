<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crasificado;
use Excel;
use Validator;

class ClasificadoController extends Controller
{

    public function index(){
        if (request()->ajax()) {
            return datatables()->of(Crasificado::latest()->get())
                ->addColumn('action', function ($data) {
                    $button = '<a style="cursor:pointer"
                    name="edit" id="' . $data->id . '"
                    class="edit 
                    "><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a style="cursor:pointer"
                    name="delete" id="' . $data->id . '"
                    class="delete 
                    "><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('clasificados.clasificados');
    }

    public function create()
    {
        //
    }

    public function store(Request $request){
        $user = \Auth::user();
        $id = $user->id;

        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'codigo_p'        => 'required|integer',
            'nombre_p'        => 'required',
            'descripcion_p'   => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'codigo_p'        => $request->codigo_p,
            'nombre_p'        => $request->nombre_p,
            'descripcion_p'   => $request->descripcion_p,
            'user_id'         => $id
        );

        Crasificado::create($form_data);

        return response()->json(['success' => 'Clasificado insertado correctamente.']);
    }

    public function show($id){
        //
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Crasificado::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $id = $user->id;

        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'codigo_p'        => 'required|integer',
            'nombre_p'        => 'required|string|max:255',
            'descripcion_p'   => 'required|string|max:255'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'codigo_p'        => $request->codigo_p,
            'nombre_p'        => $request->nombre_p,
            'descripcion_p'   => $request->descripcion_p
        );

        Crasificado::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Usuario actualizado correctamente.']);

    }

    public function destroy($id)
    {
        $data = Crasificado::findOrFail($id);
        $data->delete();
    }

    public function downloadClasificados($type){

        $anio = date("Y");
        $data = Crasificado::get()->toArray();

        return Excel::create('CLASIFICADOR DEL GASTO '.$anio, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    
    public function downdoaldPlantillaC($type){
        
        $plantilla = $form_data = array(
            'codigo_p',        
            'nombre_p',        
            'descripcion_p'           
        );
        return Excel::create('PLANTILLA CLASIFICADOR DEL GASTO', function($excel) use ($plantilla) {
            
            $excel->sheet('mySheet', function($sheet) use ($plantilla)
            {
                $sheet->fromArray($plantilla);
            });
        })->download($type);
    }

    public function importClasificadosC(Request $request){
        $user = \Auth::user();
        $id = $user->id;

        $request->validate([
            'import_file' => 'required'
        ]);

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path, 'UTF-8')->get();

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = [
                    'user_id'         => $id,
                    'codigo_p'        => $value->codigo_p,
                    'nombre_p'        => $value->nombre_p,
                    'descripcion_p'   => $value->descripcion_p
                ];
            }

            if(!empty($arr)){
                Crasificado::insert($arr);
            }else{
                return back()->with('error', 'Compruebe los datos a importar.');        
            }
        }

        return back()->with('success', 'Datos importados correctamente.');
    }

}
