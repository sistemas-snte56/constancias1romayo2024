<?php

namespace App\Http\Controllers;

use App\Imports\MaestrosImport;
use App\Models\Delegacion;
use App\Models\Genero;
use App\Models\Maestro;
use App\Models\Region;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MaestroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $maestros = Maestro::paginate(100);
        //dd($maestros);

        $regiones = Region::with('delegaciones');

        return view('maestros.index', compact('regiones') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regiones = Region::all();
        // $delegaciones = Delegacion::all()->asc(''); 
        $delegaciones = Delegacion::orderBy('delegacion', 'asc')->get();
        $generos = Genero::all(); 
        return view('maestros.create', compact('regiones','delegaciones','generos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'selecciona_region' => 'required',
            'selecciona_delegacion' => 'required',
            'selecciona_genero' => 'required',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            // 'apellido_materno' => 'required',
            'email' => 'required',
            'telefono' => 'required|digits:10',
            // 'rfc' => 'required|digits:13',
            'rfc' => ['required', 'regex:/^[a-zA-Z]{4}[0-9]{6}[a-zA-Z0-9]{3}$/'],
            'numero_personal' => 'required|numeric',
        ]);

        $maestro = new Maestro();
        // $maestro->nombre = strtoupper($request->input('nombre'));
        $maestro->id_delegacion = $request->input('selecciona_delegacion');
        $maestro->id_genero = $request->input('selecciona_genero');
        $maestro->nombre = strtoupper($request->input('nombre'));
        $maestro->apaterno = strtoupper($request->input('apellido_paterno'));
        $maestro->amaterno = strtoupper($request->input('apellido_materno'));
        $maestro->email = $request->input('email');
        $maestro->telefono = $request->input('telefono');
        $maestro->rfc = strtoupper($request->input('rfc'));
        $maestro->npersonal = $request->input('numero_personal');
        $maestro->folio = "NULL";
        // $maestro->codigo_id = substr(uniqid(bin2hex(random_bytes(8))), 0, 17);
        $maestro->codigo_id = sprintf(
            "%04s-%04s-%04s-%04s",
            substr(uniqid(), 0, 4),
            substr(uniqid(), 4, 4),
            substr(uniqid(), 8, 4),
            substr(uniqid(), 12, 4)
        );        

        $maestro->save();

        // return redirect('maestros.index')->with('success');
        return redirect('/maestros')->with('success', 'Su registro se guardo con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maestro $maestro)
    {
        // $maestro = Maestro::find($maestro);
        return view('maestros.show',compact('maestro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maestro $maestro)
    {
       
        $regiones = Region::all();
        $delegaciones = Delegacion::orderBy('delegacion', 'asc')->get();
        $generos = Genero::all();
        // $delegacion = Delegacion::find($maestro->id_delegacion);
        // $region = $delegacion ? $delegacion->region : null;

        return view('maestros.edit', compact('maestro','regiones','delegaciones','generos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maestro $maestro)
    {
        $validated = $request->validate([
            // 'selecciona_region' => 'required',
            'selecciona_delegacion' => 'required',
            'selecciona_genero' => 'required',
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            // 'apellido_materno' => 'required',
            'email' => 'required',
            'telefono' => 'required|digits:10',
            'rfc' => ['required', 'regex:/^[a-zA-Z]{4}[0-9]{6}[a-zA-Z0-9]{3}$/'],
            'numero_personal' => 'required|numeric',
        ]);

        if (
            (int)$request->selecciona_delegacion !== $maestro->id_delegacion ||
            (int)$request->selecciona_genero !== $maestro->id_genero ||
            $request->nombre !== $maestro->nombre ||
            $request->apellido_paterno !== $maestro->apaterno ||
            $request->apellido_materno !== $maestro->amaterno ||
            $request->email !== $maestro->email ||
            $request->telefono !== $maestro->telefono ||
            $request->rfc !== $maestro->rfc ||
            (int)$request->numero_personal !== $maestro->npersonal             
            ) {
                $maestro->id_delegacion = $request->input('selecciona_delegacion');
                $maestro->id_genero = $request->input('selecciona_genero');
                $maestro->nombre = $request->input('nombre');
                $maestro->apaterno = $request->input('apellido_paterno');
                $maestro->amaterno = $request->input('apellido_materno');
                $maestro->email = $request->input('email');
                $maestro->telefono = $request->input('telefono');
                $maestro->rfc = $request->input('rfc');
                $maestro->npersonal = $request->input('numero_personal');
                $maestro->update();
                return redirect()->route('maestro.show',$maestro)->with('update_ok','Información del maestro actualizada con exito.');
        } else {
            return redirect()->route('maestro.show',$maestro)->with('update_ok', 'No se realizo ningun cambio.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maestro $maestro)
    {
        $maestro->delete();
        return redirect()->back()->with('delete_ok','Su registro ha sido eliminado.');
    }

    public function importMaestros()
    {
        return view('maestros.import');
    }

    public function importMaestrosExcelData(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'importar_archivo' => 'required|file'
        ]);


        Excel::import(new MaestrosImport, $request->file('importar_archivo'));

        return redirect('/maestros')->with('status','Archivo importado satisfactoriamente.');
    }

    public function consultaForm()
    {
        // return view('maestros.consulta');
        return view('consulta.consulta');
    }
    
    public function consulta(Request $request)
    {
        // $rfc = $request->input('rfc');
        // // $maestro = Maestro::where('rfc', $rfc)->first();
        // $maestro = Maestro::where('rfc', $rfc)->get();
    
        // if ($maestro) {
        //     return view('consulta.detalle', compact('maestro'));
        // } else {
        //     return redirect()->route('consulta.form')->with('error', 'No se encontró ningún maestro con el RFC proporcionado.');
        // }

        $rfc = $request->input('rfc');
        $maestros = Maestro::where('rfc', $rfc)->get();
    
        return view('consulta.busqueda', compact('maestros', 'rfc'));


    }
    


    public function totalMaestros(Maestro $maestro, $id)
    {

        #Consulta query
        /* 
            $maestros = Maestro::select(
                'regions.region',
                'regions.sede',
                'delegacions.delegacion',
                'maestros.id',
                'maestros.nombre',
                'maestros.apaterno',
                'maestros.amaterno',
                'maestros.npersonal',
                'maestros.email',
                'maestros.codigo_id'
            )
            ->join('delegacions', 'delegacions.id', '=', 'maestros.id_delegacion')
            ->join('regions', 'regions.id', '=', 'delegacions.id_region')
            ->where('regions.id', $id)
            ->get();

            return view('maestros.region-totales', compact('maestros'));
        */
        

        $region = Region::findOrFail($id);
        $maestros = Maestro::with('delegacion.region')
        ->whereHas('delegacion.region', function ($query) use ($id) {
            $query->where('id', $id);
        })
        ->get();

        $maestrosCount = $maestros->count();
    
        return view('maestros.region-totales', compact('maestros','region','maestrosCount'));
    

    }





}
