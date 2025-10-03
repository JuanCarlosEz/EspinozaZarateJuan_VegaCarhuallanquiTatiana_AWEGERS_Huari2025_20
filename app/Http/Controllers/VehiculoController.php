<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function mapa()
    {
        // Ejemplo de datos. En producción reemplaza por consulta a BD:
        $vehiculos = [
            [
                'id' => 1,
                'nombre' => 'Vehículo #001',
                'placa' => 'ABC-123',
                'lat' => -12.06513,
                'lng' => -75.20486,
                'last_update' => '10:25 AM',
                'speed' => 45,
                'status' => 'activo', // activo | lento | offline
                'zona' => 'Centro'
            ],
            [
                'id' => 2,
                'nombre' => 'Vehículo #002',
                'placa' => 'XYZ-789',
                'lat' => -12.06800,
                'lng' => -75.20700,
                'last_update' => '10:20 AM',
                'speed' => 0,
                'status' => 'lento',
                'zona' => 'Norte'
            ],
            [
                'id' => 3,
                'nombre' => 'Vehículo #003',
                'placa' => 'LMN-456',
                'lat' => -12.07050,
                'lng' => -75.21050,
                'last_update' => '09:45 AM',
                'speed' => null,
                'status' => 'offline',
                'zona' => 'Sur'
            ],
        ];

        return view('vehiculos.mapa', compact('vehiculos'));
    }
}
