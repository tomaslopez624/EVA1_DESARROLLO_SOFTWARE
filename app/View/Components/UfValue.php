<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UfValue extends Component
{
    public $valorUf;

    public function __construct()
    {
        $this->valorUf = $this->obtenerUfDelDia();
    }

    private function obtenerUfDelDia()
    {
        try {
            // Consumo de servicio externo (API mindicador.cl)
            $response = Http::timeout(5)->get('https://mindicador.cl/api/uf');
            
            if ($response->successful()) {
                $datos = $response->json();
                return '$' . number_format($datos['serie'][0]['valor'], 2, ',', '.');
            }
        } catch (\Exception $e) {
            Log::error('Error al obtener la UF: ' . $e->getMessage());
        }

        return 'No disponible';
    }

    public function render()
    {
        return view('components.uf-value');
    }
}