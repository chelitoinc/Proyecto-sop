<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;

class PlantillaController extends Controller
{
    public function index()
    {
        $reportes = Reporte::orderBy('id', 'asc')->get();
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
