<?php

namespace App\Http\Controllers;

use App\Models\Enlace;
use App\Models\Facultativo;
use App\Models\Facultativo_Autorizado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnlaceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $usuarioId = $user->ID_user;
        $usuarios = User::all();

        // ID_facultativos autorizados
        $facultativosAutorizados = Facultativo_Autorizado::where('ID_user', $usuarioId)
            ->pluck('ID_facultativo');

        // Obtener los ID_user de facultativos autorizados
        $usuariosFacultativos = Facultativo::whereIn('ID_facultativo', $facultativosAutorizados)
            ->pluck('ID_user');

        // Obtener enlaces que sean del usuario actual o de usuarios facultativos autorizados
        $UsuariosEnlaces = Enlace::where('ID_user', $usuarioId)
            ->orWhereIn('ID_user', $usuariosFacultativos)
            ->paginate(10);

        // ID_user (pacientes) que autorizaron al facultativo logueado
        $usuariosQueMeAutorizaron = Facultativo_Autorizado::where('ID_facultativo', function ($query) use ($usuarioId) {
            $query->select('ID_facultativo')
                ->from('Facultativos')
                ->where('ID_user', $usuarioId);
        })->pluck('ID_user');

        // Enlaces del facultativo logueado y de esos pacientes
        $todosEnlaces = Enlace::where('ID_user', $usuarioId)
            ->orWhereIn('ID_user', $usuariosQueMeAutorizaron)
            ->paginate(10);

        if ($user->tipo_user == 'admin') {

            // Obtener los enlaces paginados, por ejemplo, 10 enlaces por página
            $enlaces = Enlace::paginate(10);

            return view('mcc.admin.enlaces', compact('enlaces', 'usuarios'));
        }

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.enlaces', compact('todosEnlaces', 'usuarios'));
        }

        return view('mcc.paciente.enlaces', compact('UsuariosEnlaces', 'usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $user = Auth::user();
        $usuarios = User::all();

        if ($user->tipo_user === 'admin') {
            return view('mcc.admin.nuevoEnlace', compact('usuarios'));
        }
        if ($user->tipo_user === 'facultativo') {
            return view('mcc.facultativo.nuevoEnlace', compact('usuarios'));
        }

        return view('mcc.paciente.nuevoEnlace', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validar los datos recibidos del formulario
        $request->validate([
            'ID_user' => 'required|exists:users,ID_user', // El usuario existe
            'nombre_url' => 'nullable|string|max:100',
            'ruta_enlace' => 'required|url|max:2048', // Valida que sea una URL válida
            'observacion_url' => 'nullable|string',
            'fecha_alta' => 'required|date',
        ]);

        // Crear un nuevo enlace
        $enlace = new Enlace;
        $enlace->ID_user = $request->ID_user;
        $enlace->nombre_url = $request->nombre_url;
        $enlace->ruta_enlace = $request->ruta_enlace;
        $enlace->observacion_url = $request->observacion_url;
        $enlace->fecha_alta = $request->fecha_alta;
        $enlace->save();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.enlaces')->with('success', 'Enlace creado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.enlaces')->with('success', 'Enlace creado correctamente.');
        }

        return redirect()->route('paciente.enlaces')->with('success', 'Enlace creado correctamente.');
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
        $enlace = Enlace::findOrFail($id);
        $usuarios = User::all();

        if ($user->tipo_user == 'paciente') {
            // Solo permitir acceso si el enlace pertenece al usuario logueado
            if ($enlace->ID_user !== $user->ID_user) {
                return redirect()->back()->with('error', 'No tienes permiso para editar este enlace.');
            }

            return view('mcc.paciente.editEnlace', compact('enlace', 'usuarios'));
        }

        if ($user->tipo_user == 'facultativo') {
            // Solo permitir acceso si el enlace pertenece al usuario logueado
            if ($enlace->ID_user !== $user->ID_user) {
                return redirect()->back()->with('error', 'No tienes permiso para editar este enlace.');
            }

            return view('mcc.facultativo.editEnlace', compact('enlace', 'usuarios'));
        }

        return view('mcc.admin.editEnlace', compact('enlace', 'usuarios'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $enlace = Enlace::findOrFail($id);

        // Validar los datos recibidos del formulario
        $request->validate([
            'ID_user' => 'sometimes|exists:users,ID_user',
            'nombre_url' => 'nullable|string|max:100',
            'ruta_enlace' => 'sometimes|url|max:2048',
            'observacion_url' => 'nullable|string',
            'fecha_alta' => 'sometimes|date',
        ]);

        $enlace->ID_user = $request->input('ID_user', $enlace->ID_user);
        $enlace->nombre_url = $request->input('nombre_url', $enlace->nombre_url);
        $enlace->ruta_enlace = $request->input('ruta_enlace', $enlace->ruta_enlace);
        $enlace->observacion_url = $request->input('observacion_url', $enlace->observacion_url);
        $enlace->fecha_alta = $request->input('fecha_alta', $enlace->fecha_alta);

        $enlace->save();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.enlaces')->with('success', 'Enlace actualizado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.enlaces')->with('success', 'Enlace actualizado correctamente.');
        }

        return redirect()->route('paciente.enlaces')->with('success', 'Enlace actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $enlace = Enlace::findOrFail($id);

        $enlace->delete();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.enlaces')->with('success', 'Enlace eliminado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.enlaces')->with('success', 'Enlace eliminado correctamente.');
        }

        return redirect()->route('paciente.enlaces')->with('success', 'Enlace eliminado correctamente.');

    }
}
