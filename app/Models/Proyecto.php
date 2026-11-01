<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    // Método para simular la base de datos según el requerimiento del examen
    public static function obtenerDatosEstaticos()
    {
        return collect([
            [
                'id' => 1,
                'nombre' => 'Actualización Sistema Municipal',
                'fecha_inicio' => '2026-11-01',
                'estado' => 'En proceso',
                'responsable' => 'Tomás López',
                'monto' => 1250000
            ],
            [
                'id' => 2,
                'nombre' => 'Vivero de Nativos',
                'fecha_inicio' => '2026-11-15',
                'estado' => 'Planificado',
                'responsable' => 'Siboney',
                'monto' => 850000
            ]
        ]);
    }
}