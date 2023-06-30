<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\Helpers\PdfHelper;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class ConformidadReparacionSancorPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();

		$this->body();

		$this->firma();

        $this->Output();
        exit;
	}

	function Header() {
		$this->SetFont('Arial', 'B', 12);
		$this->SetTextColor(167, 30, 111);
		$this->y = 15;
        $this->x = 15;
		$this->Cell(85, 5, 'CONFORMIDAD REPARACION', $this->b, 1, 'L');

		$this->SetFont('Arial', 'U', 9);
		$this->SetTextColor(5, 99, 193);
        $this->x = 15;
		$this->Cell(85, 5, 'www.sancorseguros.com', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 9);
		$this->SetTextColor(0, 0, 0);
        $this->x = 15;
		$this->Cell(85, 5, 'Ruta Nacional 34 km 257 - 2322 - Sunchales - Santa Fe', $this->b, 1, 'L');

        $this->Image(storage_path().'/app/public/sancor_75_anos.jpg', 125, 15, 70, 20);

        $this->y += 7;
        $this->Line(15, $this->y, 195, $this->y);
	}

	function body() {
		$this->SetFont('Arial', '', 11);
		$text = 'La aceptación de la siguiente nota, implica la aprobación con conformidad a las reparaciones realizadas sobre los equipos:';
		foreach ($this->siniestro->bienes as $bien) {
			$text .= ' '.$bien->nombre;
			if (!is_null($bien->marca)) {
				$text .= ', Marca: '.$bien->marca;
			}
			if (!is_null($bien->numero_serie)) {
				$text .= ', Numero de Serie: '.$bien->numero_serie;
			}
			$text .= '.';
		}
		$this->x = 15;
		$this->y += 5;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$text = 'Quedando totalmente cumplidas las obligaciones asumidas por SANCOR COOPERATIVA DE SEGUROS LTDA. a quien cedo y transfiero en este acto todos los derechos y acciones de que fuera titular con motivo del siniestro Número: '.$this->siniestro->numero_siniestro.' ocurrido en el domicilio ubicado en '.$this->siniestro->domicilio_completo_google.'.';

		$this->x = 15;
		$this->y += 5;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$text = 'Habiéndose dado plenos efectos cancelatorios y sin que nada más tenga que reclamar de Sancor Cooperativa de Seguros Limitada, liberándola de toda responsabilidad por el siniestro antes mencionado.';
		$this->x = 15;
		$this->y += 5;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);
	}

	function firma() {
		$this->y += 40;
		$this->x = 15;
		$this->Cell(85, 7, 'Fecha:                    ......................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(85, 7, 'Nombre:                 ......................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(85, 7, 'Documento y Nro:  ......................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(85, 7, 'Firma:                     ......................................', $this->b, 1, 'L');
		$this->y += 5;
	}

	function Footer() {
		PdfHelper::footerScrapFree($this);
	}

}