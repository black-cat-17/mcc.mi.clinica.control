<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    use HasFactory;

    // Tabla en la base de datos
    protected $table = 'Enlaces';

    // Clave primaria de la tabla 'ID_enlace'
    protected $primaryKey = 'ID_enlace';

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'ID_user',
        'nombre_url',
        'ruta_enlace',
        'observacion_url',
        'fecha_alta',
    ];

    // Deshabilita el uso de los timestamps automáticos
    public $timestamps = false;

    // Relación con el modelo User (Enlace pertenece a un User)
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user');
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
