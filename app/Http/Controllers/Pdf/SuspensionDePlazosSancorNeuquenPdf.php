<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class SuspensionDePlazosSancorNeuquenPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();
        $this->Output();
        exit;
	}

	function Header() {
		$this->printInfo();

		$this->printData();
	}

	function printInfo() {
		$this->y = 20;
		$this->x = 30;
		$this->SetFont('Arial', '', 10);
		$this->Cell(75, 5, 'Certificada plegada sin sobre c/av. de retorno', $this->b, 1, 'L');

		$this->x = 130;
		$this->Cell(80, 5, 'Nequén, __ de ____ de '.date('Y'), $this->b, 1, 'L');

		$this->x = 30;
		$this->Cell(100, 5, 'Señor/a.', $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(100, 5, $this->siniestro->asegurado->nombre, $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(100, 5, 'Tucumán 5980, S2008QLL Rosario, Santa Fe, Argentina', $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(100, 5, '2000 - Rosario', $this->b, 1, 'L');
	}

	function printData() {

		$this->x = 30;
		$this->y += 10;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(150, 10, 'Ref.: legajo '.$this->siniestro->numero_siniestro.' – '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y').' – Ref: .-', $this->b, 1, 'R');

		$this->SetFont('Arial', '', 10);
		$this->x = 30;
		$this->Cell(150, 10, 'De nuestra mayor consideración:', $this->b, 1, 'L');
		

		$this->x = 30;
		$this->y += 10;
		$text = 'Nos dirigimos a usted sobre su denuncia administrativa recepcionada en fecha '.date_format($this->siniestro->fecha_denuncia, 'd/m/Y').', respecto del siniestro ocurrido el '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y').', de la cual quedamos debidamente impuestos.';

		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);

		$this->x = 30;
		$this->y += 5;
		$text = 'Al respecto debemos comunicarle que por derechos que nos confieren las Condiciones Generales y Particulares de la Póliza '.$this->siniestro->poliza->numero_poliza.', Referencia '.$this->siniestro->poliza->referencia.', avalada por los artículos 46 y 55 s.s y c.c. de la ley de seguros N° 17.418 SUSPENDEMOS los términos para expresarnos acerca de su derecho hasta nos sea presentada en nuestras oficinas los Informes técnicos de los artefactos dañados, confeccionados por un Servicio Técnico con datos del asegurado, de c/u de los artefactos(modelo, N° de serie, antigüedad del mismo) y causas del Daño.';
		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);

		$this->x = 30;
		$this->y += 5;
		$text = 'Quedando al aguardo de una pronta respuesta y a v/entera disposición para cualquier aclaración que estimen necesaria, saludamos a Uds. muy cordialmente.';
		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);
	}
}