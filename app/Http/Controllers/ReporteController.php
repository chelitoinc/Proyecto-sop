<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;
use App\Beneficiario;
use App\Crasificado;
use App\Responsable;

use Validator;


class ReporteController extends Controller
{

    public function index()
    {
       
        $reportes = Reporte::query('reporte')
            ->join('beneficiario', 'reporte.beneficiario_id', '=', 'beneficiario.id')
            ->join('responsable', 'reporte.responsable_id', '=', 'responsable.id')
            ->select('reporte.*', 'beneficiario.beneficiario', 'responsable.num_proyecto')
            ->get();

        
        $beneficiarios = Beneficiario::orderBY('id','DESC')->get();
        $crasificados = Crasificado::orderBY('id','DESC')->get();
        $responsables = Responsable::orderBy('id', 'DESC')->get();

        if (request()->ajax()) {
            return datatables()->of($reportes)
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
        return view('reportes.reportes',[
            'beneficiarios' => $beneficiarios,
            'crasificados'  => $crasificados,
            'responsables'  => $responsables
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        $id = $user->id;
        $importe_letra = "PESOS";

        $rules = array(
            'num_folio'         => 'required|integer',
            'codigo'            => 'required|string',
            'fecha'             => 'required|date',
            'periodo'           => 'required|string',
            'clasi_financiera'  => 'required|string',
            'importe'           => 'required',
            'concepto'          => 'required|string',
            'num_procedencia'   => 'required|integer',
            'nom_procedencia'   => 'required|string',
            'cuenta_bancaria'   => 'required|string',
            'beneficiario_id'   => 'required|integer',
            'partida_id'        => 'required|integer',
            'responsable_id'    => 'required|string',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'num_folio'         => $request->num_folio,
            'codigo'            => $request->codigo,
            'fecha'             => $request->fecha,
            'periodo'           => $request->periodo,
            'clasi_financiera'  => $request->clasi_financiera,
            'importe'           => $request->importe,
            'importe_letra'     => $importe_letra,
            'concepto'          => $request->concepto,
            'num_procedencia'   => $request->num_procedencia,
            'nom_procedencia'   => $request->nom_procedencia,
            'cuenta_bancaria'   => $request->cuenta_bancaria,
            'beneficiario_id'   => $request->beneficiario_id,
            'partida_id'        => $request->partida_id,
            'responsable_id'    => $request->responsable_id,
            'user_id'           => $id
        );

        Reporte::create($form_data);

        return response()->json(['success' => 'Se ha creado un nuevo reporte.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Reporte::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $id = $user->id;
        $importe_letra = "PESOS";

        $rules = array(
            'num_folio'         => 'required|integer',
            'codigo'            => 'required|string',
            'fecha'             => 'required|date',
            'periodo'           => 'required|string',
            'clasi_financiera'  => 'required|string',
            'importe'           => 'required',
            'concepto'          => 'required|string',
            'num_procedencia'   => 'required|integer',
            'nom_procedencia'   => 'required|string',
            'cuenta_bancaria'   => 'required|string',
            'beneficiario_id'   => 'required|integer',
            'partida_id'        => 'required|integer',
            'responsable_id'    => 'required|string',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'num_folio'         => $request->num_folio,
            'codigo'            => $request->codigo,
            'fecha'             => $request->fecha,
            'periodo'           => $request->periodo,
            'clasi_financiera'  => $request->clasi_financiera,
            'importe'           => $request->importe,
            'importe_letra'     => $importe_letra,
            'concepto'          => $request->concepto,
            'num_procedencia'   => $request->num_procedencia,
            'nom_procedencia'   => $request->nom_procedencia,
            'cuenta_bancaria'   => $request->cuenta_bancaria,
            'beneficiario_id'   => $request->beneficiario_id,
            'partida_id'        => $request->partida_id,
            'responsable_id'    => $request->responsable_id,
            'user_id'           => $id
        );

        Reporte::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Reporte actualizado correctamente.']);

    }

    public function destroy($id)
    {
        $data = Reporte::findOrFail($id);
        $data->delete();
    }
}
