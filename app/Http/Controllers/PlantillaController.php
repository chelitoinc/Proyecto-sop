<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;
use Barryvdh\DomPDF\Facade as PDF;

class PlantillaController extends Controller
{
    public function index()
    {
        $reportes = Reporte::query('reporte')
            ->join('beneficiario', 'reporte.beneficiario_id', '=', 'beneficiario.id')
            ->join('responsable',  'reporte.responsable_id',  '=', 'responsable.id')
            ->join('partida',      'reporte.partida_id',      '=', 'partida.id')
            ->select('reporte.*', 
                                'beneficiario.beneficiario', 
                                'beneficiario.rfc',
                                'beneficiario.num_beneficiario',
                                'beneficiario.tipo',
                                'responsable.num_proyecto',
                                'responsable.dependencia',
                                'responsable.unidad',
                                'responsable.num_dependencia',
                                'responsable.num_unidad',
                                'partida.codigo_p',
                                'partida.nombre_p'
                    )
            ->where('reporte.id',2)
            ->orderBy('id', 'ASC')
            ->get();

        $pdf   = PDF::loadView('plantillas.plantillaReporte', compact('reportes')); 

		return $pdf->stream();   

        //$reportes = Reporte::orderBy('id', 'asc')->where('id',2)->get();
        /* return view('plantillas.plantillaReporte',[
            'reportes' => $reportes
        ]);  */
    }

    public function exportpdf($id){

        $reportes = Reporte::query('reporte')
            ->join('beneficiario', 'reporte.beneficiario_id', '=', 'beneficiario.id')
            ->join('responsable', 'reporte.responsable_id', '=', 'responsable.id')
            ->select('reporte.*', 
                                'beneficiario.beneficiario', 
                                'beneficiario.rfc',
                                'beneficiario.num_beneficiario',
                                'beneficiario.tipo',
                                'responsable.num_proyecto',
                                'responsable.dependencia',
                                'responsable.unidad'
                    )
            ->where('reporte.id',$id)
            ->orderBy('id', 'ASC')
            ->get();

        $pdf = PDF::loadView('plantillas.plantilla', [
            'reportes' => $reportes
        ]); 

        return $pdf->stream();
        
        /* Example to download a document PDF */
        /* $pdf = PDF::loadView('plantillas.example');

        return $pdf->download('Example.pdf'); */

    }

}
