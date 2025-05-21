<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::paginate(10);
        $user = Auth::user();

        // Obtener todos los usuarios con tipo 'facultativo'
        $usuarios = User::where('tipo_user', 'facultativo')->get();

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.especialidades', compact('especialidades'));
        }

        return view('mcc.admin.especialidades', compact('especialidades'));
    }

    public function create()
    {
        $user = Auth::user();
        // Obtener todos los usuarios con tipo 'facultativo'
        $usuarios = User::where('tipo_user', 'facultativo')->get();

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.nuevaEspecialidad');
        }

        return view('mcc.admin.nuevaEspecialidad');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'nombre_especialidad' => 'nullable|string|max:100',
            'descripcion' => 'nullable|string',
        ]);

        // Crear un nuevo enlace
        $especialidad = new Especialidad;
        $especialidad->nombre_especialidad = $request->nombre_especialidad;
        $especialidad->descripcion = $request->descripcion;
        $especialidad->save();

        // Obtener todos los usuarios con tipo 'facultativo'
        $usuarios = User::where('tipo_user', 'facultativo')->get();

        if ($user->tipo_user == 'facultativo') {

            return redirect()->route('facultativo.especialidades')->with('success', 'Especialidad creada correctamente.');
        }

        return redirect()->route('admin.especialidades')->with('success', 'Especialidad creada correctamente.');
    }

    public function edit(string $id)
    {
        $user = Auth::user();
        $especialidad = Especialidad::findOrFail($id);

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.editEspecialidad', compact('especialidad'));
        }

        return view('mcc.admin.editEspecialidad', compact('especialidad'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $especialidad = Especialidad::findOrFail($id);

        $especialidad->nombre_especialidad = $request->nombre_especialidad;
        $especialidad->descripcion = $request->descripcion;

        $especialidad->save();

        if ($user->tipo_user == 'facultativo') {

            return redirect()->route('facultativo.especialidades')->with('success', 'Especialidad actualizada correctamente.');
        }

        return redirect()->route('admin.especialidades')->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $user = Auth::user();
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();

        if ($user->tipo_user == 'facultativo') {

            return redirect()->route('facultativo.especialidades')->with('success', 'Especialidad eliminada correctamente.');
        }

        return redirect()->route('admin.especialidades')->with('success', 'Especialidad eliminada correctamente.');
    }
}
