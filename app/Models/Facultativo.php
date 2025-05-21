<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultativo extends Model
{
    use HasFactory;

    // Tabla en la base de datos
    protected $table = 'Facultativos';

    // Clave primaria es una combinación de 'ID_user' y 'ID_especialidad'
    protected $primaryKey = 'ID_facultativo';

    // 'ID_user' y 'ID_especialidad' son clave compuesta, por lo tanto, no se incrementan automáticamente
    public $incrementing = false;

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'ID_user',
        'ID_especialidad',
    ];

    // Deshabilita el uso de los timestamps automáticos
    public $timestamps = false;

    // Relación con el modelo User (Facultativo pertenece a un User)
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user');
    }

    // Relación con el modelo Especialidad (Facultativo pertenece a una Especialidad)
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'ID_especialidad');
    }

    // Facultativo tiene muchas instancias de Facultativo_Autorizado
    public function autorizados()
    {
        return $this->hasMany(Facultativo_Autorizado::class, 'ID_facultativo');
    }

    // Oculta el campos en la serialización
    protected $hidden = [
        //
    ];

    /**
     * Los atributos que deben ser casteados a un tipo específico.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];
}
