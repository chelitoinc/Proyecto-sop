<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beneficiario;
use Validator;

class BeneficiarioController extends Controller{
    // Modo restringido, acceso unicamente a los usuarios registrados mediante el middleware
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        if (request()->ajax()) {
            return datatables()->of(Beneficiario::latest()->get())
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
        return view('beneficiario.beneficiarios');
    }

    public function create(){
        //
    }

    public function store(Request $request){
        /* Se hace la validacion de los comapos del formulario */
        
        $user = \Auth::user();
        $id = $user->id;

        $rules = array(
            'num_beneficiario'  => 'required|int|min:4',
            'beneficiario'      => 'required|string|max:100',
            'titular'           => 'required|string|max:100',
            'enlace'            => 'required|string|max:100',
            'rfc'               => 'required|string|max:50',
            'giro'              => 'required|string|max:100',
            'telefono'          => 'required|string|max:20',
            'email'             => 'required|string|email|max:100',
            'direccion'         => 'required|string|max:150',
            'cp'                => 'required|int|min:4',
            'ciudad'            => 'required|string|max:100',
            'pais'              => 'required|string|max:100',
            'observaciones'     => 'string|max:255',
            'tipo'              => 'required|string|max:100'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'num_beneficiario'  => $request->num_beneficiario,
            'beneficiario'      => $request->beneficiario,
            'titular'           => $request->titular,
            'enlace'            => $request->enlace,
            'rfc'               => $request->rfc,
            'giro'              => $request->giro,
            'telefono'          => $request->telefono,
            'email'             => $request->email,
            'direccion'         => $request->direccion,
            'cp'                => $request->cp,
            'ciudad'            => $request->ciudad,
            'pais'              => $request->pais,
            'observaciones'     => $request->observaciones,
            'tipo'              => $request->tipo,
            'user_id'           => $id
        );

        Beneficiario::create($form_data);

        return response()->json(['success' => 'Provedor insertado correctamente.']);
    }


    public function show($id){ 

    }

    public function edit($id){
        if (request()->ajax()) {
            $data = Beneficiario::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request){
        
        $user = \Auth::user();
        $id = $user->id;

        $rules = array(
            'num_beneficiario'  => 'required|int|min:4',
            'beneficiario'      => 'required|string|max:100',
            'titular'           => 'required|string|max:100',
            'enlace'            => 'required|string|max:100',
            'rfc'               => 'required|string|max:50',
            'giro'              => 'required|string|max:100',
            'telefono'          => 'required|string|max:20',
            'email'             => 'required|string|email|max:100',
            'direccion'         => 'required|string|max:150',
            'cp'                => 'required|int|min:4',
            'ciudad'            => 'required|string|max:100',
            'pais'              => 'required|string|max:100',
            'observaciones'     => 'string|max:255',
            'tipo'              => 'required|string|max:100'
        );
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'num_beneficiario'  => $request->num_beneficiario,
            'beneficiario'      => $request->beneficiario,
            'titular'           => $request->titular,
            'enlace'            => $request->enlace,
            'rfc'               => $request->rfc,
            'giro'              => $request->giro,
            'telefono'          => $request->telefono,
            'email'             => $request->email,
            'direccion'         => $request->direccion,
            'cp'                => $request->cp,
            'ciudad'            => $request->ciudad,
            'pais'              => $request->pais,
            'observaciones'     => $request->observaciones,
            'tipo'              => $request->tipo,
            'user_id'           => $id
        );

        Beneficiario::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Provedor actualizado correctamente.']);
    }

    public function destroy($id){
        
        $data = Beneficiario::findOrFail($id);
        $data->delete(); 
    }



}
