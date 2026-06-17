<?php

namespace App\Http\Controllers;

use App\Models\Hospitalizacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HospitalizacionController extends Controller
{

    public function index()
    {
        $hospitalizacion=Hospitalizacion::all();
        return view('hospitalizacion', compact('hospitalizacion'));
    }
    public function pacientes_por_sala()
    {
        // Hacemos la consulta estructurada de CodeIgniter pero con la sintaxis de Laravel
        $lista = DB::table('hospitalizacion as h')
            ->join('sala as s', 'h.sala_id', '=', 's.id')
            ->select('s.nombre as sala', DB::raw('COUNT(h.id) as total'))
            ->whereNull('h.fecha_alta')
            ->groupBy('s.id', 's.nombre')
            ->get();

        // Enviamos el resultado directamente a tu vista de salas
        return view('consultaSala', compact('lista'));
    }
   public function pacientes_alfabetico()
{
    $lista = DB::table('paciente as p')
        ->join('tipo_diagnostico as d', 'p.tipo_diagnostico_id', '=', 'd.id')
        ->select('p.nombre', 'p.apellido', 'd.nombre as diagnostico')
        ->orderBy('p.apellido')
        ->get();

    return view('consultaSala', compact('lista'));
}
public function pacientes_hospitalizados()
{
    // Mantenemos estrictamente tus nombres de tablas en singular y tus mismos JOINs
    $lista = DB::table('hospitalizacion as h')
        ->join('paciente as p', 'h.paciente_id', '=', 'p.id')
        ->join('sala as s', 'h.sala_id', '=', 's.id')
        ->join('tipo_diagnostico as xd', 'p.tipo_diagnostico_id', '=', 'xd.id')
        ->select('p.nombre', 'p.apellido', 'xd.nombre as diagnostico', 'h.fecha_ingreso', 's.nombre as sala')
        ->whereNull('h.fecha_alta') // Mismo filtro: donde fecha_alta sea NULL
        ->get();

    // Retornamos la vista pasando exactamente la variable '$lista'
    return view('consultaHospitalizados', compact('lista'));
}
public function pacientes_con_dias()
{
    $lista = DB::table('hospitalizacion as h')
        ->join('paciente as p', 'h.paciente_id', '=', 'p.id')
        ->join('sala as s', 'h.sala_id', '=', 's.id')
        ->join('tipo_diagnostico as d', 'p.tipo_diagnostico_id', '=', 'd.id')
        ->select(
            'p.nombre',
            'p.apellido',
            'd.nombre as diagnostico',
            's.nombre as sala',
            'h.fecha_ingreso',
            'h.fecha_alta',
            DB::raw("
                DATEDIFF(
                    LEAST(COALESCE(h.fecha_alta, CURDATE()), CURDATE()),
                    h.fecha_ingreso
                ) AS dias_internado
            "),
            DB::raw("
                CASE 
                    WHEN h.fecha_alta IS NULL     THEN 'Internado indefinidamente'
                    WHEN h.fecha_alta > CURDATE() THEN 'Internado pero con fecha de salida '
                    ELSE 'Alta'
                END AS estado
            ")
        )
        ->get();

    return view('consultaHospitalizados', compact('lista'));
}
 
    public function store(Request $request)
    {
        $nueva = new Hospitalizacion();
        $nueva->paciente_id = $request->paciente_id;
        $nueva->fecha_ingreso  = $request->fecha_ingreso;
        $nueva->fecha_alta = $request->fecha_alta;
        $nueva->sala_id = $request->sala_id;
        $nueva->save();
        return redirect('hospitalizacion');

    }
    public function update(Request $request,$id)
    {
        $hos = Hospitalizacion::find($id);
        $hos->paciente_id = $request->paciente_id;
        $hos->fecha_ingreso  = $request->fecha_ingreso;
        $hos->fecha_alta = $request->fecha_alta;
        $hos->sala_id = $request->sala_id;
        $hos->save();
        return redirect('hospitalizacion');
    }
    public function destroy($id)
    {
        $hospitalizacion = Hospitalizacion::find($id);
        $hospitalizacion->delete();
        return redirect('hospitalizacion');
    }
}
