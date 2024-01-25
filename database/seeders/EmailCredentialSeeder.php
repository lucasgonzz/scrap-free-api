<?php

namespace Database\Seeders;

use App\Models\EmailCredential;
use Illuminate\Database\Seeder;

class EmailCredentialSeeder extends Seeder
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
                'email'                 => 's.scrap.free@gmail.com',
                'password'              => 'P1rul1t0SF',
                'gestor_scrap_free_id'  => 1,
            ],
            [
                'email'                 => 'lucasgonzalez5500@gmail.com',
                'password'              => 'ypbk qayo phdb dfbo',
                'gestor_scrap_free_id'  => 2,
            ],
        ];
        foreach ($models as $model) {
            EmailCredential::create($model);
        }
    }
}
