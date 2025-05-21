<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    // Tabla en la base de datos
    protected $table = 'Especialidades';

    // Clave primaria de la tabla
    protected $primaryKey = 'ID_especialidad';

    // Deshabilita el uso de los timestamps automáticos
    public $timestamps = false;

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'nombre_especialidad',
        'descripcion',
    ];

    // Relación con el modelo Facultativo (Especialidad tiene muchos Facultativos)
    public function facultativos()
    {
        return $this->hasMany(Facultativo::class, 'ID_especialidad');
    }

    /**
     * Los atributos que deben ser casteados a un tipo específico.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // No hay campos específicos que deseemos casteados
    ];
}
