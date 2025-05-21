<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Facultativo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultativoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener todos los usuarios con tipo 'facultativo'
        $usuarios = User::where('tipo_user', 'facultativo')->get();

        $especialidades = Especialidad::all();

        // Obtener los enlaces paginados, por ejemplo, 10 facultativos por página
        $facultativos = Facultativo::paginate(10);

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.facultativos', compact('facultativos', 'usuarios', 'especialidades'));
        }

        return view('mcc.admin.facultativos', compact('facultativos', 'usuarios', 'especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Obtener todos los facultativos
        $facultativos = Facultativo::paginate(10);

        // Obtener todos los usuarios con tipo 'facultativo'
        $usuarios = User::where('tipo_user', 'facultativo')->get();

        $especialidades = Especialidad::all();

        if ($user->tipo_user === 'facultativo') {

            return view('mcc.facultativo.nuevoFacultativo', compact('facultativos', 'usuarios', 'especialidades'));
        }

        return view('mcc.admin.nuevoFacultativo', compact('facultativos', 'usuarios', 'especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validar los datos recibidos del formulario
        $request->validate([
            'ID_user' => 'required|exists:users,ID_user', // El usuario existe: Facultativo
            'ID_especialidad' => 'required|exists:Especialidades, ID_especialidad', // El Especialidad existe
        ]);

        // Crear un nuevo facultativo
        $facultativo = new Facultativo;
        $facultativo->ID_user = $request->ID_user;
        $facultativo->ID_especialidad = $request->ID_especialidad;
        $facultativo->save();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.facultativos')->with('success', 'Facultativo creado correctamente.');
        }

        return redirect()->route('admin.facultativos')->with('success', 'Facultativo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $facultativo = Facultativo::findOrFail($id);

        // Obtener todos los usuarios con tipo 'facultativo'
        $usuarios = User::where('tipo_user', 'facultativo')->get();

        $especialidades = Especialidad::all();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'facultativo') {
            return view('mcc.facultativo.editFacultativo', compact('facultativo', 'usuarios', 'especialidades'));
        }

        return view('mcc.admin.editFacultativo', compact('facultativo', 'usuarios', 'especialidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $facultativo = Facultativo::findOrFail($id);

        $facultativo->ID_user = $request->ID_user;
        $facultativo->ID_especialidad = $request->ID_especialidad;

        $facultativo->save();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.facultativos')->with('success', 'Facultativo actualizado correctamente.');
        }

        return redirect()->route('admin.facultativos')->with('success', 'Facultativo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $facultativo = Facultativo::findOrFail($id);

        $facultativo->delete();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.facultativos')->with('success', 'Facultativo eliminado correctamente.');
        }

        return redirect()->route('admin.facultativos')->with('success', 'Facultativo eliminado correctamente.');
    }
}
