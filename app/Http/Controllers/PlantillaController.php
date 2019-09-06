<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;

class PlantillaController extends Controller
{
    public function index()
    {
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
            ->where('reporte.id',2)
            ->orderBy('id', 'ASC')
            ->get();

        //$reportes = Reporte::orderBy('id', 'asc')->where('id',2)->get();
        return view('plantillas.plantilla',[
            'reportes' => $reportes
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
