<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sala = Sala::all();
        return view('salas', compact('sala'));
    }

    public function store(Request $request)
    {
        $nueva = new Sala();
        $nueva->nombre = $request->nombre;
        $nueva->capacidad = $request->capacidad;
        $nueva->save();
        return redirect('salas');
    }

    public function update(Request $request, $id)
    {
        $sala = Sala::find($id);
        $sala->nombre= $request->nombre;
        $sala->capacidad=$request->capacidad;
        $sala->save();
        return redirect('salas');
    }

    public function destroy($id)
    {
        $sala = Sala::Find($id);
        $sala->delete();
        return redirect('salas');
    }
}
