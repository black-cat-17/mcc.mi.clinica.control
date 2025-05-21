<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::paginate(10);
        $user = Auth::user();

        if ($user->tipo_user == 'paciente') {

            return view('mcc.paciente.perfil', compact('user'));
        }

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.perfil', compact('user'));
        }

        return view('mcc.admin.usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();

        return view('mcc.admin.nuevoUsuario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellidos' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'tipo_user' => 'required|in:paciente,facultativo,admin',
            'fecha_alta' => 'nullable|date',
            'activo' => 'nullable|boolean',
        ]);

        // Crear el nuevo usuario
        $usuarios = new User;
        $usuarios->fill($request->except('password'));
        $usuarios->password = Hash::make($request->password);
        $usuarios->fecha_alta = now();
        $usuarios->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.usuarios')->with('success', 'Usuario creado correctamente.');
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
        $usuario = User::findOrFail($id);
        $user = Auth::user();

        if ($user->tipo_user == 'paciente') {

            return view('mcc.paciente.editUsuario', compact('user'));
        }

        if ($user->tipo_user == 'facultativo') {

            return view('mcc.facultativo.editUsuario', compact('user'));
        }

        return view('mcc.admin.editUsuario', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);
        $user = Auth::user();

        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->tipo_user = $request->tipo_user;
        $usuario->fecha_alta = now();
        $usuario->activo = $request->activo ?? 1;  // Por defecto lo dejamos SI activo

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        if ($user->tipo_user == 'paciente') {

            return redirect()->route('paciente.perfil')->with('success', 'Usuario actualizado correctamente.');
        }

        if ($user->tipo_user == 'facultativo') {

            return redirect()->route('facultativo.perfil')->with('success', 'Usuario actualizado correctamente.');
        }

        return redirect()->route('admin.usuarios')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);

        $usuario->delete();

        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado correctamente.');
    }
}
