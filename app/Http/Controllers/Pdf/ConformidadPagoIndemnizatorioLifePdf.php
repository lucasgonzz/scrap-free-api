<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class ConformidadPagoIndemnizatorioLifePdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();
		
		$this->titleGerente();
			
		$this->referencia();

		$this->texto();

		$this->indemnizacion();

		$this->firma();

        $this->Output();
        exit;
	}

	function Header() {
        $this->Image(storage_path().'/app/public/life_logo.png', 130, 15, 70, 20);

        $this->SetFont('Arial', '', 12);
        $this->y = 40;
        $this->x = 105;
		$this->Cell(90, 7, 'Fecha......................, Lugar......................', $this->b, 1, 'R');

	}

	function titleGerente() {
        $this->SetFont('Arial', '', 11);

        $this->x = 20;
		$this->Cell(100, 5, 'Sr. Gerente', $this->b, 1, 'L');
		
        $this->x = 20;
		$this->Cell(100, 5, 'Life Seguros de Personas y Patrimoniales S.A', $this->b, 1, 'L');
		
        $this->x = 20;
		$this->Cell(100, 5, 'Presente', $this->b, 1, 'L');
	}

	function referencia() {
        $this->SetFont('Arial', 'B', 11);

        $this->y += 5;

        $this->x = 20;
		$this->Cell(100, 5, 'Referencia: '.$this->siniestro->poliza->referencia, $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(100, 5, 'Stro Nro: '.$this->siniestro->numero_siniestro, $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(100, 5, 'Asegurado: '.$this->siniestro->asegurado, $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(100, 5, 'Domicilio: '.$this->siniestro->domicilio_completo_google, $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(100, 5, 'Póliza Nro.: '.$this->siniestro->poliza->numero_poliza, $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(100, 5, 'Fecha de Stro.: '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y'), $this->b, 1, 'L');
	}

	function texto() {
        $this->SetFont('Arial', '', 11);

		$text = 'Tengo el agrado de dirigirme al Sr. Gerente en mi carácter de Asegurado, con el objeto de poner en su conocimiento que fijo el reclamo con carácter único, total y definitivo por los daños derivados del evento que tuviera lugar en la fecha y lugar indicado, en la suma conjunta $ a cancelar a través de los medios de pago habituales, con cuya percepción me declaro totalmente resarcido a mi entera satisfacción por los daños derivados del referido evento, no teniendo nada más que reclamar bajo ningún concepto. El resarcimiento se distribuirá de la siguiente forma:';

		$this->y += 5;
		$this->x = 20;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

	}

	function indemnizacion() {
		$this->y += 5;
        $this->x = 20;
        $this->SetFont('Arial', 'BU', 11);
		$this->Cell(170, 5, 'Indemnización dineraria a través de transferencia bancaria de $: -', $this->b, 1, 'L');

		$this->y += 3;
        $this->SetFont('Arial', '', 11);
		$text = 'Autorizo a Life Seguros de Personas y Patrimoniales S.A. a acreditar el importe citado en la cuenta bancaria que a continuación detallo:';
        $this->x = 20;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$this->y += 3;
        $this->SetFont('Arial', 'B', 11);
        $this->x = 20;
		$this->Cell(170, 7, 'Titular de la cta. y DNI: '.$this->siniestro->asegurado.' - '.$this->siniestro->numero_documento, $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(170, 7, 'Banco y Sucursal: ', $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(170, 7, 'Tipo y Nro de cta: ', $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(170, 7, 'CBU Nro: ', $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(170, 7, 'Cuil: ', $this->b, 1, 'L');

		$this->y += 3;
        $this->SetFont('Arial', '', 11);
        $this->x = 20;
		$text = 'Asimismo, cumplo en ratificar que el seguro contratado con esa Aseguradora es el único vigente con relación al riesgo afectado, no existiendo otras coberturas susceptibles de ser convocadas a contribuir a la indemnización del siniestro detallado en la referencia. Sin más saludo a Ud. Muy atte';
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

	}

	function firma() {
		$this->y += 10;
        $this->SetFont('Arial', 'B', 11);
        $this->x = 20;
		$this->Cell(170, 5, 'Firma: ', $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(170, 5, 'Aclaración y Nro de DNI: ', $this->b, 1, 'L');
	}
}