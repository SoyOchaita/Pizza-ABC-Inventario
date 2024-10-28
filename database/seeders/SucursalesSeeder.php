<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalesSeeder extends Seeder
{
    public function run()
    {
        $sucursales = [
            [
                'name' => 'Roosevelt San Juan',
                'address' => 'Calzada San Juan 8-89, Zona 7',
                'latitude' => 14.61979369,
                'longitude' => -90.54444947,
            ],
            [
                'name' => 'Boulevard Liberación',
                'address' => 'Boulevard Liberación y 3a. Avenida 13 -38 Zona 9',
                'latitude' => 14.599694,
                'longitude' => -90.524583,
            ],
            [
                'name' => 'Walmart Majadas',
                'address' => 'Calz. Roosevelt 26-95, Zona 11 Com. Walmart Roosevelt',
                'latitude' => 14.625611,
                'longitude' => -90.558583,
            ],
        ];

        foreach ($sucursales as $sucursal) {
            Sucursal::create($sucursal);
        }
    }
}
