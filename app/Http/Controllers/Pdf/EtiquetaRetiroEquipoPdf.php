<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\Helpers\PdfHelper;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class EtiquetaRetiroEquipoPdf extends fpdf {

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

		$this->clienteTransporte();

		$this->remitente();
	}

	function _header() {
        $this->Image(storage_path().'/app/public/logo.png', 20, 30, 30, 30);

        $this->y = 30;
        $this->x = 60;
        $this->SetFont('Arial', 'B', 20);
		$this->Cell(47, 5, 'SCRAP FREE', $this->b, 0, 'L');
        $this->SetFont('Arial', '', 20);
		$this->Cell(80, 5, 'Reparaciones Sustentables', $this->b, 0, 'L');
	}

	function infoSiniestro() {
		$this->y = 63;
		$this->Line(20, $this->y, 220, $this->y);

        $this->SetFont('Arial', 'B', 45);
        $this->x = 20;
        $this->y += 5;
		$this->Cell(190, 15, 'Siniestro: '.$this->siniestro->numero_siniestro, $this->b, 1, 'L');

        $this->SetFont('Arial', 'B', 23);
        $this->x = 20;
		$this->Cell(190, 10, 'Destinatario: Scrap Free / Mauro Mambretti', $this->b, 1, 'L');
        $this->x = 20;
		$this->Cell(190, 10, 'Dom: Alfredo Palacios 687 , Gualeguay, E.R.', $this->b, 1, 'L');
        $this->x = 20;
		$this->Cell(190, 10, '2840', $this->b, 1, 'L');
        $this->x = 20;
		$this->Cell(190, 10, 'Tel: (3444) 15 41-9053 / (11) 15 2342-2506', $this->b, 1, 'L');
	}

	function clienteTransporte() {
		$this->y += 3;
		$this->Line(20, $this->y, 220, $this->y);
		$this->y += 3;
        $this->SetFont('Arial', 'B', 20);
        $this->x = 20;
		$this->Cell(52, 10, 'Cliente Transporte: ', $this->b, 1, 'L');
	}

	function remitente() {
		$this->y += 3;
		$this->Line(20, $this->y, 220, $this->y);
		$this->y += 3;
        $this->SetFont('Arial', '', 12);
        $this->x = 20;
		$this->Cell(30, 5, 'Remitente:  ', $this->b, 0, 'L');
        $this->SetFont('Arial', 'B', 12);
		$this->Cell(30, 5, $this->siniestro->asegurado->nombre, $this->b, 1, 'L');

        $this->SetFont('Arial', '', 12);
        $this->x = 20;
		$this->Cell(30, 5, 'TEL:  ', $this->b, 0, 'L');
        $this->SetFont('Arial', 'BUI', 12);
		$this->Cell(30, 5, $this->siniestro->asegurado->telefono, $this->b, 1, 'L');
	}

}