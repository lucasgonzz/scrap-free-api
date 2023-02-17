<?php

namespace Database\Seeders;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ct = new Controller();
        $models = [
            [
                'name'              => 'Mauro',
                'company_name'      => 'Scrap Free',
                'doc_number'        => '123',
                'email'             => 'lucasgonzalez5500@gmail.com',
                'password'          => bcrypt('123'),
                'visible_password'  => null,
            ],
            [
                'name'              => 'Empleado 1',
                'doc_number'        => '1',
                'email'             => 'lucasgonzalez550022@gmail.com',
                'password'          => bcrypt('1'),
                'visible_password'  => '1',
                'owner_id'          => 1,
                'permissions_slug'    => [
                    'siniestro.index',
                    'siniestro.store',
                    'siniestro.update',
                ],
            ],
            [
                'name'              => 'Empleado 2',
                'doc_number'        => '2',
                'email'             => 'lucasgonzalez550023@gmail.com',
                'password'          => bcrypt('2'),
                'visible_password'  => '2',
                'owner_id'          => 1,
                'permissions_slug'    => [
                    'aseguradora.index',
                    'aseguradora.delete',
                    
                    'asegurado.store',

                    'gestor_scrap_free.index',
                    'gestor_scrap_free.store',
                    'gestor_scrap_free.update',
                ],
            ],
        ];
        foreach ($models as $model) {
            $user = User::create([
                'name'              => $model['name'], 
                'company_name'      => isset($model['company_name']) ? $model['company_name'] : null,  
                'doc_number'        => $model['doc_number'], 
                'email'             => $model['email'], 
                'password'          => $model['password'],  
                'visible_password'  => $model['visible_password'],  
                'owner_id'          => isset($model['owner_id']) ? $model['owner_id'] : null,  
            ]);
            if (!is_null($user->owner_id)) {
                foreach ($model['permissions_slug'] as $permission_slug) {
                    $user->permissions()->attach($ct->getModelBy('permissions', 'slug', $permission_slug, false, 'id'));
                }
            }
        }
    }
}
