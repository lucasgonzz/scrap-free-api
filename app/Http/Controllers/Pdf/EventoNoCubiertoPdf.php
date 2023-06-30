<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class EventoNoCubiertoPdf extends fpdf {

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

        $this->Image(storage_path().'/app/public/sancor_header.jpg', 15, 15, 180, 30);

		$this->y = 50;
		$this->x = 15;
		$this->SetFont('Arial', '', 10);
		$this->Cell(75, 5, 'Certificada plegada sin sobre c/av. de retorno', $this->b, 1, 'L');

		$this->x = 120;
		$this->Cell(75, 5, '........., ........ del ............. de '.date('Y'), $this->b, 1, 'R');

		$this->x = 15;
		$this->Cell(75, 5, 'Señor/a.', $this->b, 1, 'L');
		
		$this->SetFont('Arial', 'B', 10);
		$this->x = 15;
		$this->Cell(75, 5, $this->siniestro->asegurado->nombre, $this->b, 1, 'L');
		
		$this->x = 15;
		$this->Cell(75, 5, 'Tucumán 5980, S2008QLL Rosario, Santa Fe, Argentina', $this->b, 1, 'L');
		
		$this->x = 15;
		$this->Cell(75, 5, 'Rosario, Santa Fe', $this->b, 1, 'L');
		
	}

	function printData() {

		$this->x = 15;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(150, 5, 'Ref.: legajo '.$this->siniestro->asegurado->nombre.' - Fecha:'.date_format($this->siniestro->fecha_denuncia, 'd/m/Y').' - Pzad.: '.$this->siniestro->poliza->numero_poliza.' Cert.: 0.-', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 10);
		$this->x = 15;
		$this->Cell(150, 10, 'De nuestra consideración:', $this->b, 1, 'L');
		

		$this->x = 15;
		$text = 'Por la presente, informamos a Ud. que obra en nuestro poder la denuncia administrativa recibida respecto del siniestro ocurrido el día'.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y').', de la cual quedamos debidamente impuestos.';

		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$this->y += 5;
		$this->x = 15;
		$text = 'Al respecto, debemos comunicarle que esta Aseguradora procede mediante el presente al rechazo del referido siniestro, en virtud de tratarse de un HECHO NO CUBIERTO por la Póliza de Seguro de Hogar Ref. '.$this->siniestro->poliza->referencia.', oportunamente contratado.';

		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$this->y += 5;
		$this->x = 15;
		$text = 'Por estos motivos, al no existir un hecho cubierto por la póliza referida, procedemos a deslindar toda responsabilidad que pretenda imputarse a esta Aseguradora como consecuencia del evento señalado.';

		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$this->x = 5;
		$this->y += 5;
		$this->Cell(200, 7, 'Sin otro particular, saludamos att', $this->b, 1, 'C');

	}
}