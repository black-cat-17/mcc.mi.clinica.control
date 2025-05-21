<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellidos' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:20',
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:8|confirmed',
            // 'tipo_user' => 'required|in:paciente,facultativo,admin',
            'fecha_alta' => 'nullable|date',
            'activo' => 'nullable|boolean',
            // 'nombre' => ['string', 'max:50'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'nombre' => $request->nombre,
            'apellidos' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_user' => $request->tipo_user ?? 'paciente',
            'fecha_alta' => Carbon::now(),
            'activo' => true,
        ]);

        // event(new Registered($user));

        Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        // Redirección según tipo de usuario
        switch ($user->tipo_user) {
            case 'admin':
                return redirect('/admin');
            case 'facultativo':
                return redirect('/facultativo');
            case 'paciente':
                return redirect('/paciente');
            default:
                return redirect('/login');
        }
    }
}
