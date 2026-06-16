<?php

    namespace App\Http\Controllers;

    use App\Models\Paciente;
    use Illuminate\Http\Request;

    class PacienteController extends Controller
    {
        public function index()
        {

        }

        public function store(Request $request)
        {
            $nueva = new Paciente();
            $nueva->nombre = $request->nombre; 
            $nueva->apellido = $request->apellido;
            $nueva->tipo_diagnostico_id = $request->tipo_diagnostico_id;
            $nueva->save();
            return redirect('pacientes');
        }

        public function update(Request $request,$id)
        {
            $paciente = Paciente::find($id);
            $paciente->nombre = $request->nombre; 
            $paciente->apellido = $request->apellido;
            $paciente->tipo_diagnostico_id = $request->tipo_diagnostico_id;
            $paciente->save();
            return redirect('pacientes');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy($id)
        {
            $paciente = Paciente::findOrFail($id);
            $paciente->delete();
            return redirect('pacientes');

        }
    }
