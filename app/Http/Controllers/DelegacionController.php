<?php

namespace App\Http\Controllers;

use App\Models\Delegacion;
use App\Models\Maestro;
use Illuminate\Http\Request;

class DelegacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Delegacion $delegacion)
    {
        return "Hola";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delegacion $delegacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delegacion $delegacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delegacion $delegacion)
    {
        //
    }

    public function totalMaestros(Delegacion $delegacion, $id)
    {
        $delegacion = Delegacion::findOrFail($id);

        $maestrosPorDelegacion = Maestro::with('delegacion')
            ->whereHas('delegacion', function ($query) use ($id) {
                $query->where('id', $id);
        })
        ->get()
        ->groupBy('id_delegacion');
    
        $maestrosCountPorDelegacion = $maestrosPorDelegacion->map->count();
    






        return view('delegaciones.show-maestros',compact('delegacion','maestrosPorDelegacion','maestrosCountPorDelegacion'));
    }


    
}
