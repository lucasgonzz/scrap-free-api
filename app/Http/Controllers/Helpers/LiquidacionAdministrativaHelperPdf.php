<?php

namespace App\Http\Controllers\Helpers; 

use App\Http\Controllers\CommonLaravel\Helpers\Numbers;

class LiquidacionAdministrativaHelperPDf {

	function __construct($instance, $siniestro) {
		$this->instance = $instance;
		$this->siniestro = $siniestro;

		$this->start_x = 300;
		$this->instance->SetTextColor(0,0,0);
	}

	function print() {
		$this->header();
		$this->body();
		$this->footer();

		$this->bordes();
	}

	function bordes() {
		// Abajo
		$this->instance->SetLineWidth(.5);
		$this->instance->Line(290, $this->instance->y, 510, $this->instance->y);

		// Izquierda
		$this->instance->Line(290, $this->instance->y, 290, 5);

		// Arriba
		$this->instance->Line(290, 5, 510, 5);

		// derecha
		$this->instance->Line(510, 5, 510, $this->instance->y);
	}

	function header() {
		$this->instance->y = 10;
		$this->instance->x = $this->start_x;
		$this->instance->SetFont('Arial', 'B', 10);
		$this->instance->Cell(100, 7, 'LIQUIDACION ADMINISTRATIVA', $this->instance->b, 0, 'L');

		$this->instance->y += 7;
		$this->instance->x = $this->start_x;
		$this->instance->SetFont('Arial', '', 10);
		$this->instance->Cell(100, 7, 'www.sancorseguros.com', $this->instance->b, 0, 'L');

		$this->instance->y += 7;
		$this->instance->x = $this->start_x;
		$this->instance->Cell(100, 7, 'Ruta Nacional 34 km 257 - 2322 - Sunchales - Santa Fe' , $this->instance->b, 0, 'L');

        $this->instance->Image(storage_path().'/app/public/sancor_75_anos.png', 410, 10, 90, 20);

		$this->instance->y += 10;
        $this->instance->Line(300, $this->instance->y, 500, $this->instance->y);
		$this->instance->y += 10;
	}

	function footer() {
		$this->instance->y += 15;
		$this->instance->x = $this->start_x;
        $this->instance->Line(300, $this->instance->y, 500, $this->instance->y);
		$this->instance->y += 5;
		$this->instance->Cell(160, 10, '+54 (9) 11 2654-9045 / +54 (9) 3444 41-9053' , $this->instance->b, 0, 'L');

        $this->instance->Image(storage_path().'/app/public/logo.png', 475, $this->instance->y, 25, 25);

		$this->instance->y += 10;
		$this->instance->x = $this->start_x;
		$this->instance->Cell(160, 10, 's.scrap.free@gmail.com' , $this->instance->b, 0, 'L');
		$this->instance->y += 20;

		$this->instance->liquidacion_gestor_finish_y = $this->instance->y;

	}

	function body() {
		$this->info_siniestro();

		$this->info_coberturas();

		$this->gestor_info();
	}

	function info_siniestro() {
		$this->instance->x = $this->start_x;

		$this->print_data('Siniestro:', $this->siniestro->numero_siniestro);

		$this->print_data('Asegurado:', $this->siniestro->asegurado);

		$this->print_data('Fecha ocurrencia:', !is_null($this->siniestro->fecha_ocurrencia) ? $this->siniestro->fecha_ocurrencia->format('d/m/Y') : '');
		
		$this->print_data('Ramo póliza:', !is_null($this->siniestro->ramo) ? $this->siniestro->ramo->nombre : '');
		
		$this->print_data('Numero póliza:', $this->siniestro->numero_poliza);
		
		$this->print_data('Causa del siniestro:', !is_null($this->siniestro->causa_siniestro) ? $this->siniestro->causa_siniestro->nombre : '');
		

		$this->instance->x = $this->start_x;
		$this->instance->y += 7;
		$this->instance->SetFont('Arial', 'B', 10);
		$this->instance->Cell(80, 7, 'Descripción de los hechos: ', $this->instance->b, 0, 'L');
		$this->instance->SetFont('Arial', '', 10);
		$this->instance->MultiCell(100, 5, $this->siniestro->descripcion_del_hecho, $this->instance->b, 'J', 0);

		$this->print_data('¿Siniestro bajo cobertura?', 'Si');

	}

	function print_data($title, $value) {

		$this->instance->x = $this->start_x;
		$this->instance->y += 5;
		$this->instance->SetFont('Arial', 'B', 10);
		$this->instance->Cell(80, 5, $title, $this->instance->b, 0, 'L');
		$this->instance->SetFont('Arial', '', 10);
		$this->instance->Cell(80, 5, $value, $this->instance->b, 0, 'L');

	}

	function info_coberturas() {

		$this->instance->x = $this->start_x;
		$this->instance->y += 15;
		$this->instance->SetFont('Arial', 'BUI', 10);
		$this->instance->Cell(80, 7, 'LIQUIDACIÓN', $this->instance->b, 0, 'L');

		$this->instance->x = $this->start_x;
		$this->instance->y += 7;
		$this->instance->SetFont('Arial', 'B', 10);
		$this->instance->Cell(65, 7, 'Cobertura afectada', 1, 0, 'C');
		$this->instance->Cell(35, 7, 'Suma Asegurada', 1, 0, 'C');
		$this->instance->Cell(28, 7, 'Pérdidas', 1, 0, 'C');
		$this->instance->Cell(32, 7, 'Deducible Aseg. $', 1, 0, 'C');
		$this->instance->Cell(30, 7, 'Indemnización', 1, 0, 'C');


		$this->instance->SetFont('Arial', '', 10);

		$height = 7;
		$total = 0;
		foreach ($this->siniestro->liquidacion_administrativa->coberturas as $cobertura) {
			$this->instance->x = $this->start_x;
			$this->instance->y += $height;
			
			
			$start_y = $this->instance->y;
			$this->instance->MultiCell(65, 7, $cobertura->nombre, 1, 'J', 0);
			$this->instance->x = $this->start_x + 65;
			// $this->instance->x = 75;
			$height = $this->instance->y;
			$height = $this->instance->y - $start_y;
			$this->instance->y = $start_y;

			$this->instance->Cell(35, $height, '$'.Numbers::price($cobertura->pivot->suma_asegurada), 1, 0, 'C');
			$this->instance->Cell(28, $height, '$'.Numbers::price($cobertura->pivot->perdidas), 1, 0, 'C');
			$this->instance->Cell(32, $height, '$'.Numbers::price($cobertura->pivot->deducible), 1, 0, 'C');
			$this->instance->Cell(30, $height, '$'.Numbers::price($cobertura->pivot->indemnizacion), 1, 0, 'C');

			$total += $cobertura->pivot->indemnizacion;
		}

		$this->instance->SetFillColor(237,244,27);
		$this->instance->x = $this->start_x;
		$this->instance->y += $height;
		$this->instance->SetFont('Arial', 'B', 10);
		$this->instance->Cell(160, 7, 'Total', 1, 0, 'L', 1);
		$this->instance->Cell(30, 7, '$'.Numbers::price($total), 1, 0, 'C', 1);
	}

	function gestor_info() {

		$this->instance->y += 15;

		$this->print_data('Nombre y apellido del gestor:', !is_null($this->siniestro->gestor_aseguradora) ? $this->siniestro->gestor_aseguradora->nombre : '');

		$this->instance->y += 10;
		$this->print_data('Fecha de Realización:', $this->siniestro->liquidacion_administrativa->created_at->format('d/m/Y'));

	}

}