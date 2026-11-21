<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'clave',
    ];

    protected $hidden = [
        'clave',
    ];

    // Relación uno a muchos: un usuario puede crear muchos proyectos
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'created_by');
    }

    // Datos estáticos de ejemplo
    public static function obtenerDatosEstaticos()
    {
        return collect([
            [
                'id' => 1,
                'nombre' => 'Tomás López',
                'correo' => 'tomas@techsolutions.cl',
                'clave' => bcrypt('123456'),
            ],
        ]);
    }
}