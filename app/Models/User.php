<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Tabla en la base de datos
    protected $table = 'users';

    // Clave primaria  es 'ID_user'
    protected $primaryKey = 'ID_user';

    // 'ID_user' es un valor auto incrementable
    public $incrementing = true;

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'password',
        'tipo_user',
        'fecha_alta',
        'activo',
    ];

    // Deshabilita el uso de los timestamps automáticos
    public $timestamps = false;

    // Oculta el campo 'password' en la serialización
    protected $hidden = [
        'password',
    ];

    /**
     * Los atributos que deben ser casteados a un tipo específico.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_alta' => 'datetime',
        'activo' => 'boolean',
        'password' => 'hashed',
    ];

    // Relaciones con otras tablas

    public function facultativo()
    {
        return $this->hasOne(Facultativo::class, 'ID_user');
    }
}
