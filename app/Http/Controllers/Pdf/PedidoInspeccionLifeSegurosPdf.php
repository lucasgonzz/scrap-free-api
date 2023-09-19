<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class PedidoInspeccionLifeSegurosPdf extends fpdf {

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
	}

	function printInfo() {
		$this->y = 40;
		$this->x = 105;
		$this->SetFont('Arial', '', 10);
		$this->Cell(75, 15, 'Buenos Aires, ...... de ...... de '.date('Y'), $this->b, 1, 'R');

		$this->x = 30;
		$this->Cell(100, 15, 'Ref: '.$this->siniestro->poliza->referencia, $this->b, 1, 'L');

		$this->x = 30;
		$this->Cell(100, 15, 'Póliza: '.$this->siniestro->poliza->numero_poliza, $this->b, 1, 'L');

		$this->x = 30;
		$this->Cell(100, 15, 'Siniestro: '.$this->siniestro->numero_siniestro, $this->b, 1, 'L');

		$this->x = 30;
		$this->Cell(100, 15, 'DNI: '.$this->siniestro->numero_documento, $this->b, 1, 'L');

		$this->x = 30;
		$this->Cell(100, 15, 'De nuestra consideración:', $this->b, 1, 'L');

		$text = 'Nos dirigimos a Ud. con relación al evento denunciado con fecha de ocurrencia el día '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y').', donde se vieran afectados los siguiente bienes de su propiedad;';

		foreach ($this->siniestro->bienes as $bien) {
			$text .= ' '.$bien->nombre;
		}

		$text .= ', y en un todo de acuerdo con las facultades conferidas por el Art. 46 de la Ley 17.418, solicitamos nos aporte a la mayor brevedad la siguiente documentación y/o información para el estudio y consideración del siniestro que nos ocupa:';

		$this->x = 30;
		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);

		$text = '- Coordinar inspección del bien denunciado con el Perito Liquidador designado, Scrap Free (s.scrap.free@gmail.com / 011 15 2654-9045 o al 03444 15 41-9053)';
		$this->x = 30;
		$this->y += 10;
		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);

		$text = 'Atento a ello, quedan suspendidos los plazos para nuestra determinación de aceptación o rechazo del evento denunciado (Art. 46 y 56 de la Ley de Seguros 17.418).';
		$this->x = 30;
		$this->y += 10;
		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);


		$this->x = 30;
		$this->y += 20;
		$this->Cell(100, 15, 'Sin otro particular, saludamos atentamente', $this->b, 1, 'L');
	}
}