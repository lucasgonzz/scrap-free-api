<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\Helpers\PdfHelper;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class RemitoTransportistaDevolucionPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct('L', 'mm', [297, 210]);
		$this->SetAutoPageBreak(true, 15);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();

		$this->print();

        $this->Output();
        exit;
	}

	function print() {
		$this->_header();

		$this->infoSiniestro();

		PdfHelper::bienesEtiquetaEnvio($this);

		$this->recibiConforme();

		PdfHelper::footerScrapFree($this, true, false, true);
	}

	function _header() {
        $this->y = 30;
        $this->x = 15;
        $this->SetFont('Arial', 'B', 20);
		$this->SetTextColor(167, 30, 111);

		$this->MultiCell(100, 7, 'REMITO DEVOLUCIÓN EQUIPOS', $this->b, 'L', 0);

        $this->Image(storage_path().'/app/public/logo.png', 180, 30, 30, 30);
	}

	function infoSiniestro() {
		$this->SetTextColor(0, 0, 0);

		$this->y = 63;
		$this->Line(15, $this->y, 220, $this->y);

        $this->SetFont('Arial', 'B', 45);
        $this->x = 15;
        $this->y += 5;
		$this->Cell(190, 15, 'Siniestro: '.$this->siniestro->numero_siniestro, $this->b, 1, 'L');

        $this->SetFont('Arial', 'B', 23);
        $this->x = 15;
		$this->Cell(190, 10, 'Destinatario: '.$this->siniestro->asegurado, $this->b, 1, 'L');
        $this->x = 15;
		$this->Cell(190, 10, 'Dom: '.$this->siniestro->domicilio_completo_google, $this->b, 1, 'L');
        $this->x = 15;
		$this->Cell(190, 10, 'Tel: '.$this->siniestro->telefono, $this->b, 1, 'L');
	}

	function recibiConforme() {
		$this->y += 3;
		$this->Line(15, $this->y, 220, $this->y);
		$this->y += 3;
        $this->SetFont('Arial', 'B', 20);
        $this->x = 15;
		$this->Cell(190, 10, 'Recibí Conforme: (Firmar aqui ->)', $this->b, 1, 'L');
		$this->y += 3;
	}

	function bienes() {
		$this->y += 3;
		$this->Line(15, $this->y, 220, $this->y);
		$this->y += 3;
		$x = 0;
		foreach ($this->siniestro->bienes as $bien) {
			if ($x == 0) {
				$x = 20;
			} else if ($x != 156) {
				$x += 52;
				$this->y -= 30;
			} else {
				$x = 20;
			}
	        $this->x = $x;
        	$this->SetFont('Arial', 'B', 9);
			$this->Cell(52, 5, $bien->nombre, $this->b, 1, 'L');
        	
        	$this->SetFont('Arial', '', 9);
	        $this->x = $x;
			$this->Cell(52, 5, 'Control: '.PdfHelper::getBoolean($bien, 'tiene_control'), $this->b, 1, 'L');

	        $this->x = $x;
			$this->Cell(52, 5, 'Base: '.PdfHelper::getBoolean($bien, 'tiene_base'), $this->b, 1, 'L');

	        $this->x = $x;
			$this->Cell(52, 5, 'Cable: '.PdfHelper::getBoolean($bien, 'tiene_cable'), $this->b, 1, 'L');

	        $this->x = $x;
			$this->Cell(52, 5, 'Cargador: '.PdfHelper::getBoolean($bien, 'tiene_cargador'), $this->b, 1, 'L');

	        $this->x = $x;
			$this->Cell(52, 5, 'Accesorios: '.PdfHelper::getBoolean($bien, 'accesorios'), $this->b, 1, 'L');
		}
	}

	function clienteTransporte() {
		$this->y += 3;
		$this->Line(15, $this->y, 220, $this->y);
		$this->y += 3;
        $this->SetFont('Arial', 'B', 20);
        $this->x = 15;
		$this->Cell(52, 10, 'Cliente Transporte: ', $this->b, 1, 'L');
	}

	function remitente() {
		$this->y += 3;
		$this->Line(15, $this->y, 220, $this->y);
		$this->y += 3;
        $this->SetFont('Arial', '', 12);
        $this->x = 15;
		$this->Cell(30, 5, 'Remitente:  ', $this->b, 0, 'L');
        $this->SetFont('Arial', 'B', 12);
		$this->Cell(30, 5, $this->siniestro->asegurado, $this->b, 1, 'L');

        $this->SetFont('Arial', '', 12);
        $this->x = 15;
		$this->Cell(30, 5, 'TEL:  ', $this->b, 0, 'L');
        $this->SetFont('Arial', 'BUI', 12);
		$this->Cell(30, 5, $this->siniestro->telefono, $this->b, 1, 'L');
	}

}