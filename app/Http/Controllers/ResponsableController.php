<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responsable;
use Validator;
use Excel;

class ResponsableController extends Controller
{

    public function index(){
        if (request()->ajax()) {
            return datatables()->of(Responsable::latest()->get())
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
        return view('responsables.responsables');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'dependencia'   => 'required|string',
            'unidad'        => 'required|string',
            'num_proyecto'  => 'required|string',
            'nombre'        => 'required|string'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'dependencia'   => $request->dependencia,
            'unidad'        => $request->unidad,
            'num_proyecto'  => $request->num_proyecto,
            'nombre'        => $request->nombre
        );

        Responsable::create($form_data);

        return response()->json(['success' => 'Responsable insertado correctamente.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Responsable::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        /* Se hace la validacion de los comapos del formulario */
        $rules = array(
            'dependencia'   => 'required|string',
            'unidad'        => 'required|string',
            'num_proyecto'  => 'required|string',
            'nombre'        => 'required|string'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'dependencia'   => $request->dependencia,
            'unidad'        => $request->unidad,
            'num_proyecto'  => $request->num_proyecto,
            'nombre'        => $request->nombre
        );

        Responsable::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Responsable actualizado correctamente.']);

    }

    public function destroy($id)
    {
        $data = Responsable::findOrFail($id);
        $data->delete();
    }

    public function downloadResponsables($type){

        $data = Responsable::get()->toArray();

        return Excel::create('CATALOGO DE RESPONSABLES', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    
    public function downdoaldPlantilla($type){
        
        $plantilla = $form_data = array(
            'dependencia',        
            'unidad',        
            'num_proyecto',
            'nombre'           
        );
        return Excel::create('PLANTILLA RESPONSABLES', function($excel) use ($plantilla) {
            
            $excel->sheet('mySheet', function($sheet) use ($plantilla)
            {
                $sheet->fromArray($plantilla);
            });
        })->download($type);
    }

    public function importResponsables(Request $request){
        
        $request->validate([
            'import_file' => 'required'
        ]);

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = [
                    'dependencia'   => $value->dependencia,
                    'unidad'        => $value->unidad,
                    'num_proyecto'  => $value->num_proyecto,
                    'nombre'        => $value->nombre
                ];
            }

            if(!empty($arr)){
                Responsable::insert($arr);
            }else{
                return back()->with('error', 'Compruebe los datos a importar.');        
            }
        }

        return back()->with('success', 'Datos importados correctamente.');
    }

}
