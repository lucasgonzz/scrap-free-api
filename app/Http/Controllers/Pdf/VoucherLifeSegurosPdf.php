<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class VoucherLifeSegurosPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();

		$this->gerente();

		$this->referencia();

		$this->body();

		$this->firma();

        $this->Output();
        exit;
	}

	function Header() {
        $this->Image(storage_path().'/app/public/life_logo.png', 130, 10, 60, 20);

		$this->SetFont('Arial', '', 11);
		$this->y += 25;
        $this->x = 105;
		$this->Cell(85, 5, 'Fecha: ................, Lugar: .........................', $this->b, 1, 'R');

	}

	function gerente() {
        $this->x = 20;
		$this->Cell(85, 5, 'Sr. Gerente', $this->b, 1, 'L');

        $this->x = 20;
		$this->Cell(85, 5, 'Life Seguros de Personas y Patrimoniales S.A', $this->b, 1, 'L');

        $this->x = 20;
		$this->SetFont('Arial', 'U', 11);
		$this->Cell(85, 5, 'Presente', $this->b, 1, 'L');
		$this->y += 5;
	}

	function referencia() {
		$this->SetFont('Arial', 'BU', 11);
        $this->x = 20;
		$this->Cell(85, 5, 'Referencia:', $this->b, 1, 'L');

		$this->SetFont('Arial', 'B', 11);
		
        $this->x = 20;
		$this->Cell(85, 5, 'Stro Nro.: '.$this->siniestro->numero_siniestro, $this->b, 1, 'L');
		
        $this->x = 20;
		$this->Cell(85, 5, 'Asegurado: '.$this->siniestro->asegurado, $this->b, 1, 'L');
		
        $this->x = 20;
		$this->Cell(85, 5, 'Domicilio: '.$this->siniestro->domicilio_completo_google, $this->b, 1, 'L');
		
        $this->x = 20;
		$this->Cell(85, 5, 'Póliza Nro.: '.$this->siniestro->poliza->numero_poliza, $this->b, 1, 'L');
		
        $this->x = 20;
		$this->Cell(85, 5, 'Fecha de Stro.: '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y'), $this->b, 1, 'L');
	}

	function body() {
		$this->SetFont('Arial', '', 11);
		$this->y += 5;
		$text = 'Tengo el agrado de dirigirme al Sr. Gerente en mi carácter de Asegurado, con el objeto de poner en su conocimiento que fijo el reclamo con carácter único, total y definitivo por los daños derivados del evento que tuviera lugar en la fecha y lugar indicado, en la suma conjunta $'.$this->siniestro->liquidacion_siniestro.' a cancelar a través de los medios de pago habituales, con cuya percepción me declaro totalmente resarcido a mi entera satisfacción por los daños derivados del referido evento, no teniendo nada más que reclamar bajo ningún concepto. El resarcimiento se distribuirá de la siguiente forma:';
		$this->x = 20;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);
		
		$this->SetFont('Arial', 'BU', 11);
		$this->y +=3;
        $this->x = 20;
		$this->Cell(170, 5, 'Orden de reposición Abierta en Musimundo S.A.I.C.e.I. por la suma de $'.$this->siniestro->liquidacion_siniestro.' (Pesos). --', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 11);
		$text = 'Asimismo, cumplo en ratificar que el seguro contratado con esa Aseguradora es el único vigente con relación al riesgo afectado, no existiendo otras coberturas susceptibles de ser convocadas a contribuir a la indemnización del siniestro detallado en la referencia.';
		$this->y +=3;
		$this->x = 20;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$this->y += 3;
		$this->x = 20;
		$this->Cell(170, 5, 'Sin más saludo a Ud. Muy atte.', $this->b, 1, 'L');
	}

	function firma() {

		$this->SetFont('Arial', 'B', 11);
		$this->y += 15;
		$this->x = 20;
		$this->Cell(170, 10, 'Firma:', $this->b, 1, 'L');

		$this->x = 20;
		$this->Cell(170, 10, 'Aclaración y Nro de DNI:', $this->b, 1, 'L');

	}

}