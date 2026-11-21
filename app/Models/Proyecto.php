<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'estado',
        'responsable',
        'monto',
        'created_by',
    ];

    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'created_by');
    }

    
    public static function obtenerDatosEstaticos()
    {
        return collect([
            [
                'id' => 1,
                'nombre' => 'Actualización Sistema Municipal',
                'fecha_inicio' => '2026-11-01',
                'estado' => 'En proceso',
                'responsable' => 'Tomás López',
                'monto' => 1250000,
                'created_by' => 1,
            ],
            [
                'id' => 2,
                'nombre' => 'Vivero de Nativos',
                'fecha_inicio' => '2026-11-15',
                'estado' => 'Planificado',
                'responsable' => 'Siboney',
                'monto' => 850000,
                'created_by' => 1,
            ],
        ]);
    }
}