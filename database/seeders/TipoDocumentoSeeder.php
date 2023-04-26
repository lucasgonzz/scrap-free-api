<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
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
                'num'    => 1,
                'nombre' => 'DNI',
                'user_id'   => 1,
            ],
            [
                'num'    => 2,
                'nombre' => 'LE',
                'user_id'   => 1,
            ],
            [
                'num'    => 3,
                'nombre' => 'LC',
                'user_id'   => 1,
            ],
            [
                'num'    => 4,
                'nombre' => 'CUIT',
                'user_id'   => 1,
            ],
        ];
        foreach ($models as $model) {
            TipoDocumento::create($model);
        }
    }
}
