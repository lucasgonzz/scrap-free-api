<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class FluctuacionElectromangneticaNoCubiertaPdf extends fpdf {

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
		$this->Cell(75, 5, $this->siniestro->asegurado, $this->b, 1, 'L');
		
		$this->x = 15;
		$this->Cell(75, 5, 'Tucumán 5980, S2008QLL Rosario, Santa Fe, Argentina', $this->b, 1, 'L');
		
		$this->x = 15;
		$this->Cell(75, 5, 'Rosario, Santa Fe', $this->b, 1, 'L');
		
	}

	function printData() {

		$this->x = 15;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(150, 5, 'Ref.: legajo '.$this->siniestro->asegurado.' - Fecha:'.date_format($this->siniestro->fecha_denuncia, 'd/m/Y').' - Pzad.: '.$this->siniestro->poliza->numero_poliza.' Cert.: 0.-', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 10);
		$this->x = 15;
		$this->Cell(150, 10, 'De nuestra consideración:', $this->b, 1, 'L');
		

		$this->x = 15;
		$text = 'Por medio del presente nos dirigimos a Ud. a fin de comunicarle el RECHAZO de la denuncia formulada con motivo del siniestro y la póliza de referencia atento encuadrar los hechos descriptos en las previsiones de las exclusiones de cobertura establecidas en: EXCLUSIONES ESPECIFICAS (para cobertura de Aparatos electrodomésticos): Cláusula 4 "La Aseguradora no responderá por: (...) b) Cualquiera de las exclusiones específicas de los riesgos de Incendio y/o Robo" - EXCLUSIONES ESPECÍFICAS (para cobertura de Incendio): Cláusula 4 "La Aseguradora no responderá por las pérdidas o daños que afecten a los bienes objeto del seguro en las circunstancias indicadas a continuación: (...) d) Ante la falta o deficiencia en la provisión de energía, aun cuando fuera momentánea, cualquiera sea la causa que las origine o a otras máquinas, sistemas u otro tipo de bienes, salvo que, en este último caso, provengan de un siniestro indemnizable que afecte directamente a la vivienda asegurada".-';

		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$this->y += 5;
		$this->x = 15;
		$text = 'Por los motivos expuestos, deslindamos toda responsabilidad que pretenda imputarse a esta Aseguradora como consecuencia del hecho mencionado y hacemos expresa reserva de derechos de repetir en su contra cualquier suma que nos veamos obligados a pagar a raíz del mismo.';

		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$this->x = 5;
		$this->y += 5;
		$this->Cell(200, 7, 'Lamentando esta situación, saludamos muy atte', $this->b, 1, 'C');

	}
}