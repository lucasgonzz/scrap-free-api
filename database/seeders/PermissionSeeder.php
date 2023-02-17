<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            'siniestro',
            'aseguradora',
            'asegurado',
            'gestor_scrap_free',
        ];
        $scopes = [
            [
                'text'  => 'Listar',
                'slug'  => 'index',
            ],
            [
                'text'  => 'Crear',
                'slug'  => 'store',
            ],
            [
                'text'  => 'Actualizar',
                'slug'  => 'update',
            ],
            [
                'text'  => 'Eliminar',
                'slug'  => 'delete',
            ],
        ];
        foreach ($models as $model) {
            foreach ($scopes as $scope) {
                Permission::create([
                    'name'  => $scope['text'].' '.$model,
                    'slug'  => $model.'.'.$scope['slug'],
                ]);
            }
        }
    }
}
