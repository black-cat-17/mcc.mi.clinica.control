<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultativo_Autorizado extends Model
{
    use HasFactory;

    // Tabla en la base de datos
    protected $table = 'Facultativos_Autorizados';

    // Clave primaria
    protected $primaryKey = 'ID_autorizado';

    // Desactivar la gestión automática de los timestamps
    public $timestamps = false;

    // Los atributos que son asignables de forma masiva
    protected $fillable = [
        'ID_user',
        'ID_facultativo',
        'fecha_alta',
        'activo',
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'ID_user');
    }

    // Relación con el facultativo (ID_facultativo)
    public function facultativo()
    {
        return $this->belongsTo(Facultativo::class, 'ID_facultativo');
    }

    /**
     * Los atributos que deben ser casteados a un tipo específico.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_alta' => 'datetime',
    ];
}
