<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use NumerosEnLetras;

use App\Reporte;
use App\Beneficiario;
use App\Crasificado;
use App\Responsable;
use App\Partida;
use App\Importe;

use Validator;

class ReporteController extends Controller
{

    public function index()
    {
       
        $partidas = Partida::orderBy('id','DESC')->get();

        $folios = Reporte::orderBY('id','ASC')->distinct()->get();

        $reportes = Reporte::query('reporte')
            ->join('beneficiario', 'reporte.beneficiario_id', '=', 'beneficiario.id')
            ->join('responsable',  'reporte.responsable_id',  '=', 'responsable.id')
            ->select('reporte.*', 'beneficiario.beneficiario', 'responsable.num_proyecto')
            ->get(); 
            
        
        $beneficiarios = Beneficiario::orderBY('id','ASC')->get();
        $crasificados  = Crasificado::orderBY('id','ASC')->get();
        $responsables  = Responsable::orderBy('id', 'ASC')->get();

        if (request()->ajax()) {
            return datatables()->of($reportes)
                ->addColumn('action', function ($data) {
                    $button = '<a style="cursor:pointer"name="edit" id="' . $data->id . '"
                    class="edit btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a style="cursor:pointer" name="delete" id="' . $data->id . '"
                    class="delete btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reportes.reportes' ,[
            'reportes'      => $reportes,
            'beneficiarios' => $beneficiarios,
            'crasificados'  => $crasificados,
            'responsables'  => $responsables,
            'folios'        => $folios
        ]);
    }

    public function create(){}

    public function store(Request $request)
    {

        $user = \Auth::user();
        $id = $user->id;

        $rules = array(
            'num_folio'         => 'required|integer',
            'codigo'            => 'required|string',
            'fecha'             => 'required|date',
            'periodo'           => 'required|string',
            'concepto'          => 'required|string',
            'nom_procedencia'   => 'required|string',
            'cuenta_bancaria'   => 'required|string',
            'beneficiario_id'   => 'required|integer',
            'responsable_id'    => 'required|string'/* ,
            'importe'           => 'required' */
        );


        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $total = 0;
        
        if($request->partida_id){
            $importe = $request->partida_id;
            foreach ($importe as $key => $value) {
                $numero = new Importe();
                $numero->importe       =  $request->importe[$key];
                $numero->importe_letra =  strtoupper(NumerosEnLetras::convertir($request->importe[$key],'Pesos',false,'Centavos'));
                $numero->num_folio     =  $request->num_folio;
                $numero->partida_id    =  $request->partida_id[$key];
                $numero->save();
            }
            foreach ($importe as $key => $value) {
                $total +=  $request->importe[$key];
            }
        }

        $form_folios = array(
            'num_folio'         => $request->num_folio,
            'codigo'            => strtoupper($request->codigo),
            'fecha'             => $request->fecha,
            'periodo'           => strtoupper($request->periodo),
            'concepto'          => strtoupper($request->concepto),
            'importe_total'     => $total,
            'nom_procedencia'   => strtoupper($request->nom_procedencia),
            'cuenta_bancaria'   => strtoupper($request->cuenta_bancaria),
            'beneficiario_id'   => $request->beneficiario_id,
            'responsable_id'    => $request->responsable_id,
            'user_id'           => $id
        );

        Reporte::create($form_folios);


        return response()->json([
            'success' => 'Se ha creado un nuevo reporte.'
            ]
        );
    }

    public function show(Request $request)//parametro $id
    {
        $partidas = Partida::orderBy('id','DESC')->get();
        
        $importes = Importe::query('importes')->where('num_folio', '=', $request->numeroFolio)->get();

        return view('reportes.editar', [
            'importes' => $importes,
            'partidas' => $partidas
        ]);
    }

    public function edit($id){

        if (request()->ajax()) {
            
            $data = Reporte::findOrFail($id);
            return response()->json(['data' => $data]);
        }

    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $id = $user->id;

        $rules = array(
            'num_folio'         => 'required|integer',
            'codigo'            => 'required|string',
            'fecha'             => 'required|date',
            'periodo'           => 'required|string',
            'concepto'          => 'required|string',
            'nom_procedencia'   => 'required|string',
            'cuenta_bancaria'   => 'required|string',
            'beneficiario_id'   => 'required|integer',
            'responsable_id'    => 'required|string'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_folios = array(
            'num_folio'         => $request->num_folio,
            'codigo'            => strtoupper($request->codigo),
            'fecha'             => $request->fecha,
            'periodo'           => strtoupper($request->periodo),
            'concepto'          => strtoupper($request->concepto),
            'nom_procedencia'   => strtoupper($request->nom_procedencia),
            'cuenta_bancaria'   => strtoupper($request->cuenta_bancaria),
            'beneficiario_id'   => $request->beneficiario_id,
            'responsable_id'    => $request->responsable_id,
            'user_id'           => $id
        );

        Reporte::whereId($request->hidden_id)->update($form_folios);

        return response()->json(['success' => 'Reporte actualizado correctamente.']);

    }

    public function updateImporte(Request $request){

        $total = 0;

        if($request->partida_id){
            $importe = $request->partida_id;
            foreach ($importe as $key => $value) {
                $numero = new Importe();
                $numero->importe       =  $request->importe[$key];
                $numero->importe_letra =  strtoupper(NumerosEnLetras::convertir($request->importe[$key],'Pesos',false,'Centavos'));
                //$numero->partida_id    =  $request->partida_id[$key];
                $numero->update();
            }
            foreach ($importe as $key => $value) {
                $total +=  $request->importe[$key];
            }
        }

        $form_folios = array(
            'importe_total'     => $total
        );
        $id = Reporte::query('reporte')->where('num_folio',$request->num_folio)->select('id')->get();
        
        Reporte::where('num_folio','=',$request->num_folio)->update($form_folios);

        return back()->with('success', 'Datos actualizados correctamente.'.$id);

    }

    public function destroy($id){
        $data = Reporte::findOrFail($id);
        $data->delete();
    }

    public function exportpdf(Request $request){

        $folio = $request->folio;

        $reportes = Reporte::query('reporte')
            ->join('beneficiario', 'reporte.beneficiario_id', '=', 'beneficiario.id')
            ->join('responsable',  'reporte.responsable_id',  '=', 'responsable.id')
            ->select('reporte.*', 
                                'beneficiario.beneficiario', 
                                'beneficiario.rfc',
                                'beneficiario.num_beneficiario',
                                'beneficiario.tipo',
                                'responsable.num_proyecto',
                                'responsable.dependencia',
                                'responsable.unidad',
                                'responsable.num_dependencia',
                                'responsable.num_unidad'
                    )
            ->where('reporte.num_folio',$folio)
            ->orderBy('id', 'ASC')
            ->get();

            /* sacando folio  */
            //$folio = Reporte::query('reporte')->where('num_folio',$id)->select('num_folio')->get();
            //$folio2 = Importe::query('importes')->where('num_folio',$folio)->get();

            $tables = Importe::query('importes')
            ->join('partida',     'importes.partida_id', '=', 'partida.id')
            ->join('reporte',     'importes.num_folio', '=', 'reporte.num_folio')
            ->join('responsable', 'reporte.responsable_id', '=', 'responsable.id')
            ->select('importes.*', 'partida.descripcion_p', 
                                   'partida.codigo_p', 
                                   'responsable.num_unidad',
                                   'responsable.num_dependencia',
                                   'responsable.num_proyecto')
            ->where('importes.num_folio',$folio)
            ->get();


        /* SELECT SUM(importe) from reporte; */
        $sumas = Importe::query('importes')
        ->where('num_folio', $folio)
        ->sum('importe');
        $cifraLetras = strtoupper(NumerosEnLetras::convertir($sumas,'M.M',true));

        $pdf = PDF::loadView('plantillas.plantilla', [
            'reportes'      => $reportes,
            'tables'        => $tables,
            'sumas'         => number_format($sumas, 2),
            'cifraLetras'   => $cifraLetras 
        ]); 

        return $pdf->stream();
            
    }

}
