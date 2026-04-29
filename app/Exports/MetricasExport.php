<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MetricasExport implements FromCollection, WithHeadings, WithMapping
{

    public $siniestros;

    function __construct($siniestros) {
        $this->siniestros = $siniestros;
    }


    public function map($row): array
    {
        return [
            $row['numero_siniestro'],
            $row['descripcion_bien'],
            $row['causa_dano'],
            $row['siniestro_cerrado'],
            $row['fecha_ocurrencia'],
            $row['domicilio'],
        ];
    }

    public function headings(): array
    {
        return [
            'Numero siniestro',
            'Descripción de bien',
            'Causa del daño',
            'Siniestro cerrado (Sí/No)',
            'Fecha de ocurrencia',
            'Domicilio',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $lineas = [];

        // dd($this->siniestros[0]->posible_causa_relation);

        foreach ($this->siniestros as $siniestro) {

            foreach ($siniestro->bienes as $bien) {

                $domicilio = '';

                if ($siniestro->provincia) {
                    $domicilio .= $siniestro->provincia->nombre;
                }

                if ($siniestro->localidad) {
                    $domicilio .= ' '.$siniestro->localidad->nombre;
                }

                $linea = [
                    'numero_siniestro'  => $siniestro->numero_siniestro,
                    'descripcion_bien'  => $bien->nombre,
                    'causa_dano'        => !is_null($siniestro->posible_causa_relation) ? $siniestro->posible_causa_relation->nombre : $siniestro->posible_causa,
                    'siniestro_cerrado' => $siniestro->resolucion_siniestro ? $siniestro->resolucion_siniestro->nombre : '',
                    'fecha_ocurrencia'  => $siniestro->fecha_ocurrencia->format('d/m/y'),
                    'domicilio'         => $domicilio,
                    'gestor'            => $domicilio,
                ];

                $lineas[] = $linea;
            }
        }
        
        return collect($lineas);
    }
}
