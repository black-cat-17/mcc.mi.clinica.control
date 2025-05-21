<?php

namespace App\Http\Controllers;

use App\Models\Facultativo;
use App\Models\Facultativo_Autorizado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutorizadoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener todos los usuarios con tipo 'facultativo'
        $facultativos = User::where('tipo_user', 'facultativo')->get();

        $userId = Auth::user()->ID_user;

        // Obtener los ID_facultativo del usuario logueado
        $misFacultativos = Facultativo::where('ID_user', $userId)->pluck('ID_facultativo');

        // Buscar autorizaciones de esos facultativos
        $autorizadosFacultativos = Facultativo_Autorizado::whereIn('ID_facultativo', $misFacultativos)
            ->paginate(10);

        if ($user->tipo_user == 'admin') {

            // Obtener los enlaces paginados, por ejemplo, 10 autorizados por página
            $autorizados = Facultativo_Autorizado::paginate(10);

            return view('mcc.admin.autorizados', compact('autorizados', 'facultativos'));
        }

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.autorizados', compact('autorizadosFacultativos', 'facultativos'));
        }
        $autorizadosPaciente = Facultativo_Autorizado::where('ID_user', $userId)->paginate(10);

        return view('mcc.paciente.autorizados', compact('autorizadosPaciente', 'facultativos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Obtener todos los pacientes con tipo 'paciente'
        $pacientes = User::where('tipo_user', 'paciente')->get();

        // Obtener todos los facultativos
        $facultativos = Facultativo::all();

        if ($user->tipo_user === 'admin') {
            return view('mcc.admin.nuevoAutorizado', compact('pacientes', 'facultativos'));
        }

        if ($user->tipo_user === 'facultativo') {
            return view('mcc.facultativo.nuevoAutorizado', compact('pacientes', 'facultativos'));
        }

        return view('mcc.paciente.nuevoAutorizado', compact('pacientes', 'facultativos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Buscar el paciente por el ID enviado en la solicitud y asegurarse de que es un paciente
        $paciente = User::where('tipo_user', 'paciente')
            ->where('ID_user', $request->ID_user) // Verificamos que el ID sea un paciente
            ->first();

        // Verificar si el paciente y el facultativo existen y son válidos
        if (! $paciente) {
            return redirect()->back()->withErrors(['error' => 'Paciente no encontrado o inválido.']);
        }

        // Validar los datos recibidos del formulario
        $request->validate([
            'ID_user' => 'required|exists:users,ID_user', // El usuario existe: Paciente
            'ID_facultativo' => 'required|exists:Facultativos,ID_facultativo', // El facultativo existe
            'fecha_alta' => 'nullable|date',
            'activo' => 'nullable|boolean',
        ]);

        // Crear un nuevo autorizado
        $autorizado = new Facultativo_Autorizado;
        $autorizado->ID_user = $paciente->ID_user; // Aquí tomamos solo el ID del paciente
        $autorizado->ID_facultativo = $request->ID_facultativo;
        $autorizado->activo = $request->activo ?? 1;
        $autorizado->fecha_alta = now();
        $autorizado->save();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.autorizados')->with('success', 'Autorizado creado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.autorizados')->with('success', 'Autorizado creado correctamente.');
        }

        return redirect()->route('paciente.autorizados')->with('success', 'Autorizado creado correctamente.');
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
        $autorizado = Facultativo_Autorizado::findOrFail($id);

        // Obtener todos los usuarios con tipo 'paciente'
        $pacientes = User::where('tipo_user', 'paciente')->get();

        // Obtener todos los facultativos
        $facultativos = Facultativo::whereHas('user', function ($query) {
            $query->where('tipo_user', 'facultativo');
        })->get();

        if ($user->tipo_user == 'admin') {
            return view('mcc.admin.editAutorizado', compact('autorizado', 'pacientes', 'facultativos'));
        }

        if ($user->tipo_user == 'facultativo') {
            return view('mcc.facultativo.editAutorizado', compact('autorizado', 'pacientes', 'facultativos'));
        }

        return view('mcc.paciente.editAutorizado', compact('autorizado', 'pacientes', 'facultativos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $autorizado = Facultativo_Autorizado::findOrFail($id);

        $autorizado->ID_user = $request->ID_user; // Aquí tomamos solo el ID del paciente
        $autorizado->ID_facultativo = $request->ID_facultativo;
        $autorizado->activo = $request->activo ?? 1;
        $autorizado->fecha_alta = now();
        $autorizado->save();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.autorizados')->with('success', 'Autorizado actualizado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.autorizados')->with('success', 'Autorizado actualizado correctamente.');
        }

        return redirect()->route('paciente.autorizados')->with('success', 'Autorizado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $autorizado = Facultativo_Autorizado::findOrFail($id);

        $autorizado->delete();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.autorizados')->with('success', 'Autorizado eliminado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.autorizados')->with('success', 'Autorizado eliminado correctamente.');
        }

        return redirect()->route('paciente.autorizados')->with('success', 'Autorizado eliminado correctamente.');
    }
}
