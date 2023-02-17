<?php

namespace Database\Seeders;

use App\Models\Asegurado;
use Illuminate\Database\Seeder;

class AseguradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            [
                'num'                       => 1,
                'nombre'                    => 'Lucas',
                'telefono'                  => '244434233',
                'telefono_alternativo'      => '4234324324',
                'email'                     => 'lucasgonzalez5500@gmail.com',
                'direccion'                 => 'Carmen gadea 787',
                'notas_direccion'           => 'Es una calle muy larga y oscura',
                'notas'                     => 'Este se tarda en pagar las cosas',
                'user_id'                   => 1,
            ],
        ];
        foreach ($models as $model) {
            $asegurado = Asegurado::create($model);
            $asegurado->aseguradoras()->attach(rand(1,2));
        }
    }
}
