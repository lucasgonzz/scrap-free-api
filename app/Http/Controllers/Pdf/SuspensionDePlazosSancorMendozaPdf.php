<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class SuspensionDePlazosSancorMendozaPdf extends fpdf {

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
		$this->y = 20;
		$this->printInfo();

		$this->y = 80;
		$this->printInfo();

		$this->printData();
	}

	function printInfo() {
		$this->x = 30;
		$this->SetFont('Arial', '', 10);
		$this->Cell(75, 10, 'SANCOR COOP. DE SEGUROS LTDA.', $this->b, 1, 'L');
		$this->x = 30;
		$this->Cell(75, 10, 'Gutierrez 154 Cdad. Argentina', $this->b, 1, 'L');
		$this->x = 30;
		$this->Cell(75, 10, '5500 Ciudad Mendoza', $this->b, 0, 'L');

		$this->y -=  20;
		$this->x = 105;
		$this->SetFont('Arial', '', 10);
		$this->Cell(75, 10, $this->siniestro->asegurado, $this->b, 1, 'L');
		$this->x = 105;
		$this->Cell(75, 10, 'Tucumán 5980, S2008QLL Rosario, Santa Fe', $this->b, 1, 'L');
		$this->x = 105;
		$this->Cell(75, 10, '2000 Rosario Santa Fe', $this->b, 1, 'L');
	}

	function printData() {
		$this->x = 30;
		$this->y += 10;
		$text = 'Por la presente, informamos a Ud. que obra en nuestro poder la denuncia administrativa recibida en fecha '.date_format($this->siniestro->fecha_denuncia, 'd/m/Y').', referida al evento dañoso que habría ocurrido en fecha '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y').', identificado bajo el número '.$this->siniestro->numero_siniestro.' de siniestro de la cual quedamos debidamente impuestos.';

		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);

		$this->x = 30;
		$this->Cell(150, 10, 'Solicitamos tenga a bien remitirnos a la mayor brevedad posible la siguiente documentación:', $this->b, 1, 'L');

		$this->x = 30;
		$this->Cell(150, 5, '* Fotografía donde se aprecien los daños y etiquetas del equipo dañado.', $this->b, 1, 'L');
		$this->x = 30;
		$this->Cell(150, 5, '* Factura o presupuesto de reparación.', $this->b, 1, 'L');
		$this->x = 30;
		$this->Cell(150, 5, '* Factura de preexistencia del equipo dañado.', $this->b, 1, 'L');
		$this->x = 30;
		$this->Cell(150, 5, '* Constancia de CBU', $this->b, 1, 'L');

		$text = '* Nota indicando si la póliza contratada es el único seguro vigente a la fecha del evento para cubrir el riesgo afectado.';

		$this->x = 30;
		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);

		$text = 'Teniendo en cuenta que el pedido realizado resulta necesario para verificar el siniestro denunciado o eventualmente la extensión de la prestación a nuestro cargo, hasta tanto dicha indispensable información/documentación no nos sea provista, los plazos para que esta Aseguradora se expida se encuentran interrumpidos, conforme lo dispuesto por los Arts. 46 y 56 de la Ley 17.418.-';
		$this->x = 30;
		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);

		$this->x = 30;
		$this->y += 5;
		$this->Cell(150, 5, 'Sin otro particular, aprovechamos la ocasión para saludarle atte.', $this->b, 1, 'L');
	}
}