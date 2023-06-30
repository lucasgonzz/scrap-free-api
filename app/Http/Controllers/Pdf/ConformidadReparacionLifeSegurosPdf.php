<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\Helpers\PdfHelper;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class ConformidadReparacionLifeSegurosPdf extends fpdf {

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
		$this->y = 15;
        $this->x = 15;
		$this->Cell(85, 5, 'CONFORMIDAD REPARACION', $this->b, 1, 'L');

		$this->SetFont('Arial', 'U', 9);
		$this->SetTextColor(5, 99, 193);
        $this->x = 15;
		$this->Cell(85, 5, 'siniestros.patrimoniales@lifeseguros.com.ar', $this->b, 1, 'L');
        $this->x = 15;
		$this->Cell(85, 5, 'https://www.lifeseguros.com.ar/', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 9);
		$this->SetTextColor(0, 0, 0);
        $this->x = 15;
		$this->Cell(85, 5, 'Tte. Gral. Juan D. Perón 646 - CABA - C1038AAN', $this->b, 1, 'L');

        $this->Image(storage_path().'/app/public/life_logo.png', 125, 15, 70, 20);

        $this->y += 3;
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

		$text = 'Quedando totalmente cumplidas las obligaciones asumidas por Life Seguros S.A.. a quien cedo y transfiero en este acto todos los derechos y acciones de que fuera titular con motivo del siniestro Número: '.$this->siniestro->numero_siniestro.' ocurrido en el domicilio ubicado en '.$this->siniestro->domicilio_completo_google.'.';
		$this->x = 15;
		$this->y += 5;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$text = 'Habiéndose dado plenos efectos cancelatorios y sin que nada más tenga que reclamar de Life Seguros S.A., liberándola de toda responsabilidad por el siniestro antes mencionado.';
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