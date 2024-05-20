<?php

namespace App\Http\Controllers;

use App\Models\Buscador;
use App\Models\Maestro;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Writer;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('consulta.busqueda');
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
        $validacion = $request->validate([
            'numero_de_personal' => 'required|numeric'
        ]);

        $npersonal = $request->input('numero_de_personal');
        $maestros = Maestro::where('npersonal', $npersonal)->get();

        if ($maestros->count() == 0) {
            # No se encontro ningun resultado, redirigido con un mensaje de error
            return back()->with('error','No se encuentra ningun registro.');
            // return redirect('/maestros')->with('success', 'Su registro se guardo con éxito.');


        } else {
            # code...
            return view('consulta.resultado', compact('maestros','npersonal'));

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Buscador $buscador)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buscador $buscador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buscador $buscador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buscador $buscador)
    {
        //
    }

    public function consultaForm()
    {
        return view('consulta.busqueda');
    }

    public function consulta(Request $request)
    {
        $npersonal = $request->input('np');
        $maestros = Maestro::where('npersonal', $npersonal)->get();

        return view('consulta.resultado',compact('maestros','npersonal'));

    }

    public function generarPDF(Maestro $maestro, $codigo_id)
    {
        // Obtener el maestro correspondiente al código_id
        // $maestro = Maestro::where('codigo_id',$codigo_id)->first();

        try {
            $maestro = Maestro::where('codigo_id',$codigo_id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }

        // Construir el enlace con el código_id para el QR
        $enlace = route('generar.pdf', ['codigo_id' => $codigo_id]);
        $maestro->codigo_qr = $enlace;
        $maestro->update();

        $pdf = PDF::loadView('pdf.mi_pdf', compact('maestro'))
            ->setPaper('letter','portrait')
            ->setOption(['dpi' => 200, 'defaultFont' => 'Helvetica'])
            ->setWarnings(false)
            ->save('myfile.pdf');
        return $pdf->stream();
    }
}


