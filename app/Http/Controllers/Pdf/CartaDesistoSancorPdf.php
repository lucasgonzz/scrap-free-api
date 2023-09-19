<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class CartaDesistoSancorPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();
		$this->body();
        $this->Output();
        exit;
	}

	function print() {
	}

	function Header() {
		$this->y = 30;
		$this->x = 20;
		$this->SetFont('Arial', 'B', 12);
		$this->Cell(100, 10, 'ACTA DE DESISTIMIENTO', $this->b, 0, 'L');

		$this->y += 10;
		$this->x = 20;
		$this->Cell(100, 10, 'STRO. N°'.$this->siniestro->numero_siniestro, $this->b, 0, 'L');

		$this->y += 10;
		$this->x = 20;
		$this->SetFont('Arial', '', 10);
		$this->Cell(100, 10, '.................... de '.date('Y') , $this->b, 0, 'L');
		$this->y += 10;
	}

	function body() {
		$this->x = 20;
		$text = 'El que suscribe, '.$this->siniestro->asegurado.', DNI N° '.$this->siniestro->numero_documento.', me presento en este acto para formular expresamente el DESISTIMIENTO DEL RECLAMO INDEMNIZATORIO ante la Compañía Sancor Cooperativa de Seguros Limitada, con motivo del evento ocurrido en fecha '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y').', por el siguiente evento: '.$this->siniestro->descripcion_del_hecho.', que se encuentra ubicado en '.$this->siniestro->domicilio_completo_google.', denunciado sobre la póliza del ramo '.$this->siniestro->poliza->ramo->nombre.' N° '.$this->siniestro->numero_poliza.', Referencia N° '.$this->siniestro->poliza->referencia.', sobre el particular manifiesto:';

		$this->SetFont('Arial', '', 10);
		$this->MultiCell(170, 7, $text, $this->b, 'J', 0);

		$this->y += 5;
		$this->x = 20;

		$text = 'Que DESISTO de la ACCIÓN y del DERECHO que pudiera corresponder contra Sancor Cooperativa de Seguros Limitada, renunciando a cualquier acción civil, penal y/o administrativo o cualquier derecho que pudiera asistir.';
		$this->MultiCell(170, 7, $text, $this->b, 'J', 0);

		$this->y += 5;
		$this->x = 20;

		$text = 'En consecuencia, SOLICITO se tenga presente el desistimiento de la acción y del derecho formulado conforme lo establecido en los Art. 304 y 305 del C. P. C. y C.';
		$this->MultiCell(170, 7, $text, $this->b, 'J', 0);

		$this->firma();
	}

	function firma() {

		$this->y += 5;
		$this->x = 20;

		$this->Cell(100, 7, 'Firma................................................', $this->b, 1, 'L');
		$this->x = 20;
		$this->Cell(100, 7, 'Aclaración.........................................', $this->b, 1, 'L');
		$this->x = 20;
		$this->Cell(100, 7, 'DNI....................................................', $this->b, 1, 'L');

	}

}