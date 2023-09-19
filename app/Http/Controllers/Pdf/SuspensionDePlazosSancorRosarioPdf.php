<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class SuspensionDePlazosSancorRosarioPdf extends fpdf {

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

        $this->Image(storage_path().'/app/public/sancor_header.jpg', 2, 2, 206, 30);

		$this->y = 40;
		$this->x = 30;
		$this->SetFont('Arial', '', 10);
		$this->Cell(75, 5, 'Certificada plegada sin sobre c/av. de retorno', $this->b, 1, 'L');

		$this->x = 105;
		$this->Cell(75, 5, 'del '.date('Y'), $this->b, 1, 'R');

		$this->x = 30;
		$this->Cell(75, 5, 'Señor/a.', $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(75, 5, $this->siniestro->asegurado, $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(75, 5, 'Tucumán 5980, S2008QLL Rosario, Santa Fe, Argentina', $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(75, 5, '2000 - Rosario', $this->b, 1, 'L');
		
	}

	function printData() {

		$this->x = 80;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(100, 5, 'Ref.: legajo '.$this->siniestro->numero_siniestro.' – '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y').' – Ref: .-', $this->b, 1, 'R');

		$this->SetFont('Arial', '', 10);
		$this->x = 30;
		$this->Cell(150, 10, 'De nuestra mayor consideración:', $this->b, 1, 'L');
		

		$this->x = 30;
		$text = 'Nos dirigimos a Ud., respecto al asunto de referencia, a los efectos de solicitarle con carácter de información complementaria, imprescindible para la atención del siniestro que nos ocupa, y de acuerdo a las condiciones de la póliza contratada, y al art. 46 ley 17418, nos remita lo siguiente:';

		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);

		$this->SetFont('Arial', 'B', 10);

		$this->y += 5;
		$this->x = 30;
		$this->Cell(150, 7, '* Fotografía donde se aprecien los daños y etiquetas del equipo dañado.', $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(150, 7, '* Factura o presupuesto de reparación.', $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(150, 7, '* Factura de preexistencia del equipo dañado.', $this->b, 1, 'L');
		
		$this->x = 30;
		$this->Cell(150, 7, '* Constancia de CBU.', $this->b, 1, 'L');
		
		$this->x = 30;
		$this->MultiCell(150, 5, '* Nota indicando si la póliza contratada es el único seguro vigente a la fecha del evento para
cubrir el riesgo afectado.', $this->b, 'L', 0);

		$this->SetFont('Arial', '', 10);
		$this->y += 5;
		$this->x = 30;
		$this->MultiCell(150, 5, 'Ante cualquier duda, comunicarse con el gestor de Siniestros '.$this->siniestro->gestor_aseguradora->nombre.', al '.$this->siniestro->gestor_aseguradora->telefono.', o vía mail a: '.$this->siniestro->gestor_aseguradora->email.'.', $this->b, 'L', 0);

		$this->y += 5;
		$this->x = 30;
		$this->MultiCell(150, 5, 'En tanto queda suspendido el art. 56 de la ley de Seguros 17418, para pronunciarnos acerca de vuestro derecho. Sin otro particular, y esperando vuestra colaboración al respecto, saludamos muy atentamente.', $this->b, 'L', 0);
	}
}