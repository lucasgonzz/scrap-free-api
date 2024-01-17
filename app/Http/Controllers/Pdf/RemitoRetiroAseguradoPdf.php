<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\Helpers\PdfHelper;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class RemitoRetiroAseguradoPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 15);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();

		$this->_Header();

		$this->table();

		$this->_Footer();

        $this->Output();
        exit;
	}

	function _Header() {
		PdfHelper::footerScrapFree($this, false, true);
		$this->y += 3;
        $this->Line(15, $this->y, 195, $this->y);
	}

	function table() {
		$this->SetDrawColor(0,0,0);
		$this->y += 10;
		$this->start_y_table_header = $this->y;
		$this->x = 15;
		$this->Cell(180, 5, '', $this->b, 1, 'L', 1);

		$this->infoSiniestro();

		$this->accesorios();

		$this->entregaEquipo();

		$this->recibeEquipo();

		$this->printLines();
	}

	function infoSiniestro() {
		$this->SetFont('Arial', 'B', 12);
		$this->x = 15;
		$this->Cell(50, 5, 'Fecha Alta Siniestro: ', $this->b, 0, 'L');
		$this->SetFont('Arial', '', 12);
		$this->Cell(130, 5, date_format($this->siniestro->fecha_denuncia, 'd/m/Y'), $this->b, 1, 'L');
		
		$this->SetFont('Arial', 'B', 12);
		$this->x = 15;
		$this->Cell(50, 5, 'Aseguradora: ', $this->b, 0, 'L');
		$this->SetFont('Arial', '', 12);
		$this->Cell(130, 5, $this->siniestro->aseguradora->nombre, $this->b, 1, 'L');
		
		$this->SetFont('Arial', 'B', 12);
		$this->x = 15;
		$this->Cell(50, 5, 'Siniestro: ', $this->b, 0, 'L');
		$this->SetFont('Arial', '', 12);
		$this->Cell(130, 5, $this->siniestro->numero_siniestro, $this->b, 1, 'L');
		
		$this->SetFont('Arial', 'B', 12);
		$this->x = 15;
		$this->Cell(50, 5, 'Orden Serv: ', $this->b, 0, 'L');
		$this->SetFont('Arial', '', 12);
		$this->Cell(130, 5, $this->siniestro->tipo_orden_de_servicio->nombre, $this->b, 1, 'L');
		
		$this->SetFont('Arial', 'B', 12);
		$this->x = 15;
		$this->Cell(50, 5, 'Titular: ', $this->b, 0, 'L');
		$this->SetFont('Arial', '', 12);
		$this->Cell(130, 5, $this->siniestro->asegurado, $this->b, 1, 'L');
		
		$this->x = 15;
		$equipos = '';
		foreach ($this->siniestro->bienes as $bien) {
			$equipos .= '-'.$bien->nombre;
		}
		
		$this->SetFont('Arial', 'B', 12);
		$this->x = 15;
		$this->Cell(50, 5, 'Equipos: ', $this->b, 0, 'L');
		$this->SetFont('Arial', '', 12);
		$equipos = '';
		foreach ($this->siniestro->bienes as $bien) {
			$this->x = 65;
			$this->Cell(70, 5, $bien->nombre, $this->b, 1, 'L');
		}

		$this->y += 3;
		$this->Line(15, $this->y, 195, $this->y);
	}

	function accesorios() {
		$this->y += 3;
		foreach ($this->siniestro->bienes as $bien) {
			$this->SetFont('Arial', 'B', 10);
			$this->x = 15;
			$this->Cell(180, 5, $bien->nombre.': ', $this->b, 1, 'L');

			$this->SetFont('Arial', '', 10);
			$this->x = 25;
			$this->Cell(180, 5, 'Marca: '.$bien->marca, $this->b, 1, 'L');
		}
		$this->y += 3;
		$this->Line(15, $this->y, 195, $this->y);
	}

	function entregaEquipo() {
		$this->y += 3;
		$this->x = 15;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(180, 5, 'Entrega Equipo: ', $this->b, 1, 'L');

		$this->y += 3;
		$this->Line(15, $this->y, 195, $this->y);
	}

	function recibeEquipo() {
		if ($this->y >= 170) {
			$this->printLines();
			$this->AddPage();
			$this->Line(15, $this->y + 5, 195, $this->y + 5);
		} 
		$this->y += 40;

		$this->SetFont('Arial', 'B', 10);
		$this->x = 15;
		$this->Cell(180, 5, 'Recibe Equipo: Mauro Mambretti', $this->b, 1, 'L');

		$this->y -= 40;
        $this->Image(storage_path().'/app/public/firma-mauro.png', 16, $this->y, 60, 30);
		
		// $this->y += 40;
		$this->Line(15, $this->y + 41, 195, $this->y + 41);
	}

	function printLines() {
		// Izquierda
		$this->Line(15, $this->start_y_table_header, 15, $this->y + 41);

		// Derecha
		$this->Line(195, $this->start_y_table_header, 195, $this->y + 41);
	}

	function _Footer() {
		$this->y += 40;
		PdfHelper::footerScrapFree($this, false, false, false);
	}

}