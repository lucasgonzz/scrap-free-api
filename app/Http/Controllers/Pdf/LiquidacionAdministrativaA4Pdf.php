<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\CommonLaravel\Helpers\Numbers;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class LiquidacionAdministrativaA4Pdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();
		$this->body();
        $this->Output('I', str_replace('#', '-', $this->siniestro->numero_siniestro).' Liquidacion Administrativa.pdf');
        exit;
	}

	function print() {
	}

	function Header() {
		$this->y = 10;
		$this->x = 10;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(100, 7, 'LIQUIDACION ADMINISTRATIVA', $this->b, 0, 'L');

		$this->y += 7;
		$this->x = 10;
		$this->SetFont('Arial', '', 10);
		$this->Cell(100, 7, 'www.sancorseguros.com', $this->b, 0, 'L');

		$this->y += 7;
		$this->x = 10;
		$this->Cell(100, 7, 'Ruta Nacional 34 km 257 - 2322 - Sunchales - Santa Fe' , $this->b, 0, 'L');

        $this->Image(storage_path().'/app/public/sancor_75_anos.png', 110, 10, 90, 20);

		$this->y += 10;
        $this->Line(10, $this->y, 200, $this->y);
		$this->y += 10;
	}

	function Footer() {
		$this->y += 15;
		$this->x = 10;
        $this->Line(10, $this->y, 200, $this->y);
		$this->y += 5;
		$this->Cell(160, 10, '+54 (9) 11 2654-9045 / +54 (9) 3444 41-9053' , $this->b, 0, 'L');

        $this->Image(storage_path().'/app/public/logo.png', 175, $this->y, 25, 25);

		$this->y += 10;
		$this->x = 10;
		$this->Cell(160, 10, 's.scrap.free@gmail.com' , $this->b, 0, 'L');
		// $this->y += 15;

	}

	function body() {
		$this->info_siniestro();

		$this->info_coberturas();

		$this->gestor_info();
	}

	function info_siniestro() {
		$this->x = 10;

		$this->print_data('Siniestro:', $this->siniestro->numero_siniestro);

		$this->print_data('Asegurado:', $this->siniestro->asegurado);

		$this->print_data('Fecha ocurrencia:', !is_null($this->siniestro->fecha_ocurrencia) ? $this->siniestro->fecha_ocurrencia->format('d/m/Y') : '');
		
		$this->print_data('Ramo póliza:', !is_null($this->siniestro->ramo) ? $this->siniestro->ramo->nombre : '');
		
		$this->print_data('Numero póliza:', $this->siniestro->numero_poliza);
		
		$this->print_data('Causa del siniestro:', !is_null($this->siniestro->causa_siniestro) ? $this->siniestro->causa_siniestro->nombre : '');
		

		$this->x = 10;
		$this->y += 7;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(80, 7, 'Descripción de los hechos: ', $this->b, 0, 'L');
		$this->SetFont('Arial', '', 10);
		$this->MultiCell(100, 5, $this->siniestro->descripcion_del_hecho, $this->b, 'J', 0);

		$this->print_data('¿Siniestro bajo cobertura?', 'Si');

	}

	function print_data($title, $value) {

		$this->x = 10;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(80, 7, $title, $this->b, 0, 'L');
		$this->SetFont('Arial', '', 10);
		$this->Cell(80, 7, $value, $this->b, 0, 'L');

	}

	function info_coberturas() {

		$this->x = 10;
		$this->y += 15;
		$this->SetFont('Arial', 'BUI', 10);
		$this->Cell(80, 7, 'LIQUIDACIÓN', $this->b, 0, 'L');

		$this->x = 10;
		$this->y += 7;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(65, 7, 'Cobertura afectada', 1, 0, 'C');
		$this->Cell(35, 7, 'Suma Asegurada', 1, 0, 'C');
		$this->Cell(28, 7, 'Pérdidas', 1, 0, 'C');
		$this->Cell(32, 7, 'Deducible Aseg. $', 1, 0, 'C');
		$this->Cell(30, 7, 'Indemnización', 1, 0, 'C');


		$this->SetFont('Arial', '', 10);

		$height = 7;
		$total = 0;
		foreach ($this->siniestro->liquidacion_administrativa->coberturas as $cobertura) {
			$this->x = 10;
			$this->y += $height;
			
			
			$start_y = $this->y;
			$this->MultiCell(65, 7, $cobertura->nombre, 1, 'J', 0);
			$this->x = 75;
			$height = $this->y;
			$height = $this->y - $start_y;
			$this->y = $start_y;

			$this->Cell(35, $height, '$'.Numbers::price($cobertura->pivot->suma_asegurada), 1, 0, 'C');
			$this->Cell(28, $height, '$'.Numbers::price($cobertura->pivot->perdidas), 1, 0, 'C');
			$this->Cell(32, $height, '$'.Numbers::price($cobertura->pivot->deducible), 1, 0, 'C');
			$this->Cell(30, $height, '$'.Numbers::price($cobertura->pivot->indemnizacion), 1, 0, 'C');

			$total += $cobertura->pivot->indemnizacion;
		}

		$this->x = 10;
		$this->y += $height;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(160, 7, 'Total', 1, 0, 'L');
		$this->Cell(30, 7, '$'.Numbers::price($total), 1, 0, 'C');
	}

	function gestor_info() {

		$this->y += 15;

		$this->print_data('Nombre y apellido del gestor:', !is_null($this->siniestro->gestor_aseguradora) ? $this->siniestro->gestor_aseguradora->nombre : '');

		$this->y += 10;
		$this->print_data('Fecha de Realización:', $this->siniestro->liquidacion_administrativa->created_at->format('d/m/Y'));

	}

}