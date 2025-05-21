<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    // Tabla en la base de datos
    protected $table = 'Documentos';

    // Clave primaria de la tabla 'ID_documento'
    protected $primaryKey = 'ID_documento';

    // Deshabilita el uso de los timestamps automáticos
    public $timestamps = false;

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'ID_user',
        'observacion',
        'archivo_url',
        'fecha_alta',
    ];

    // Relación con el modelo User (Documento pertenece a un User)
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user', 'ID_user');
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
