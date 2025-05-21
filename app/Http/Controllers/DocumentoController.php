<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Facultativo;
use App\Models\Facultativo_Autorizado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $usuarioId = Auth::user()->ID_user;
        $usuarios = User::all();

        // ID_facultativos autorizados
        $facultativosAutorizados = Facultativo_Autorizado::where('ID_user', $usuarioId)
            ->pluck('ID_facultativo');

        // Obtener los ID_user de facultativos autorizados
        $usuariosFacultativos = Facultativo::whereIn('ID_facultativo', $facultativosAutorizados)
            ->pluck('ID_user');

        // Obtener documentos que sean del usuario actual o de usuarios facultativos autorizados
        $Usuariosdocumentos = Documento::where('ID_user', $usuarioId)
            ->orWhereIn('ID_user', $usuariosFacultativos)
            ->paginate(10);

        // ID_user (pacientes) que autorizaron al facultativo logueado
        $usuariosQueMeAutorizaron = Facultativo_Autorizado::where('ID_facultativo', function ($query) use ($usuarioId) {
            $query->select('ID_facultativo')
                ->from('Facultativos')
                ->where('ID_user', $usuarioId);
        })->pluck('ID_user');

        // Documentos del facultativo logueado y de esos pacientes
        $documentos = Documento::where('ID_user', $usuarioId)
            ->orWhereIn('ID_user', $usuariosQueMeAutorizaron)
            ->paginate(10);

        if ($user->tipo_user == 'admin') {
            // Obtener los documentos paginados, por ejemplo, 10 documentos por página y con su relación con el usuario
            $documentos = Documento::paginate(10);

            return view('mcc.admin.documentos', compact('documentos', 'usuarios'));
        }

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.documentos', compact('documentos', 'usuarios'));
        }

        return view('mcc.paciente.documentos', compact('Usuariosdocumentos', 'usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $usuarios = User::all();

        if ($user->tipo_user === 'admin') {
            return view('mcc.admin.nuevoDocumento', compact('usuarios'));
        }

        if ($user->tipo_user === 'facultativo') {
            return view('mcc.facultativo.nuevoDocumento', compact('usuarios'));
        }

        return view('mcc.paciente.nuevoDocumento', compact('usuarios'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validar los datos recibidos del formulario
        $request->validate([
            'observacion' => 'nullable|string',
            'archivo_url' => 'nullable|file|mimes:txt,pdf,jpg,png,docx|max:10240', // máx. 2MB
        ]);

        // Crear el nuevo documento
        $documento = new Documento;
        $documento->ID_user = $user->ID_user;
        $documento->observacion = $request->observacion ?? '';
        $documento->fecha_alta = now();

        if ($request->hasFile('archivo_url')) {
            $archivoPath = $request->file('archivo_url')->store('documentos_archivos', 'public');
            $documento->archivo_url = $archivoPath;
        } else {
            $documento->archivo_url = 'sin_archivo';
        }

        $documento->save();

        // Redirigir con mensaje de éxito
        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.documentos')->with('success', 'Documento creado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.documentos')->with('success', 'Documento creado correctamente.');
        }

        return redirect()->route('paciente.documentos')->with('success', 'Documento creado correctamente.');

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
        $documento = Documento::findOrFail($id);

        // Solo permitir acceso si el documento pertenece al usuario logueado
        if ($documento->ID_user !== $user->ID_user) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este documento.');
        }

        if ($user->tipo_user == 'admin') {
            return view('mcc.admin.editDocumentos', compact('documento'));
        }

        if ($user->tipo_user == 'facultativo') {
            return view('mcc.facultativo.editDocumentos', compact('documento'));
        }

        return view('mcc.paciente.editDocumentos', compact('documento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = Auth::user();
        $documento = Documento::findOrFail($id);

        // Validar los datos recibidos del formulario
        $request->validate([
            'observacion' => 'nullable|string',
            'archivo_url' => 'nullable|file|mimes:txt,pdf,jpg,png,docx|max:10240', // máx. 2MB
        ]);

        // Actualizar los datos
        $documento->observacion = $request->observacion;
        $documento->fecha_alta = $request->fecha_alta;
        $documento->ID_user = $request->ID_user;

        // Manejar el archivo si es subido
        if ($request->hasFile('archivo_url')) {
            $archivo = $request->file('archivo_url');
            $archivoPath = $archivo->store('documentos_archivos', 'public');
            $documento->archivo_url = $archivoPath;
        } else {
            $documento->archivo_url = 'sin_archivo';
        }
        $documento->save();

        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.documentos')->with('success', 'Documento actualizado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.documentos')->with('success', 'Documento actualizado correctamente.');
        }

        return redirect()->route('paciente.documentos')->with('success', 'Documento actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = Auth::user();
        $documento = Documento::findOrFail($id);

        $documento->delete();

        if ($user->tipo_user == 'admin') {
            return redirect()->route('admin.documentos')->with('success', 'Documento eliminado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {
            return redirect()->route('facultativo.documentos')->with('success', 'Documento eliminado correctamente.');
        }

        return redirect()->route('paciente.documentos')->with('success', 'Documento eliminado correctamente.');
    }
}
