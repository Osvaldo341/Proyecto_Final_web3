<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $diagnostico=Diagnostico::all();
        return view('diagnostico', compact('diagnostico'));
    }
    public function store(Request $request)
    {
        $nueva = new Diagnostico();
        $nueva->nombre = $request->nombre;
        $nueva->save();
        return redirect('tipodiagnostico');
    }


   public function update(Request $request, $id)
    {
        // 1. Buscamos el registro existente por el ID que viene en la URL
        $diagnostico = Diagnostico::findOrFail($id);
        
        // 2. Actualizamos el nombre con lo que viene del formulario
        $diagnostico->nombre = $request->nombre;
        
        // 3. Guardamos los cambios en la base de datos
        $diagnostico->save();
        
        // 4. Redireccionamos a la vista principal
        return redirect('tipodiagnostico');
    }

    public function destroy($id)
    {
        $diagnostico = Diagnostico::findOrFail($id);
        $diagnostico->delete();
        return redirect('tipodiagnostico');
    }
}
