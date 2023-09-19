<?php

namespace App\Http\Controllers\Pdf; 

use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class VoucherSancorPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();

		$this->entre();

		$this->antecedentes();

		$this->firma();

        $this->Output();
        exit;
	}

	function Header() {
		$this->SetFont('Arial', '', 9);
		$this->y = 25;
        $this->x = 20;
		$this->Cell(85, 5, 'Ruta Nacional 34 km 257 - 2322 - Sunchales - Santa Fe', $this->b, 1, 'L');
		
		$this->SetFont('Arial', 'U', 9);
		$this->SetTextColor(5, 99, 193);
        $this->x = 20;
		$this->Cell(85, 5, 'www.sancorseguros.com', $this->b, 1, 'L');

        $this->Image(storage_path().'/app/public/sancor_logo.png', 140, 20, 50, 25);

        $this->y += 10;
        $this->SetLineWidth(.1);
        $this->Line(20, $this->y, 190, $this->y);
	}

	function entre() {
		$this->SetFont('Arial', 'BU', 9);
		$this->y += 5;
		$this->x = 20;
		$this->Cell(170, 5, 'CONVENIO DE DACIÓN EN PAGO', $this->b, 1, 'C');

		$this->SetFont('Arial', 'B', 9);
		$this->x = 20;
		$this->Cell(170, 5, 'ENTRE:', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 9);
		$text = 'SANCOR COOPERATIVA DE SEGUROS LIMITADA, con domicilio en Ruta Nacional N° 34, Km 257, de la ciudad de Sunchales, provincia de Santa Fe, en adelante denominada “SANCOR SEGUROS”, por una parte; y';
		$this->x = 40;
		$this->MultiCell(150, 4, $text, $this->b, 'J', 0);

		$text = $this->siniestro->asegurado.', DNI '.$this->siniestro->numero_documento.', con domicilio en '.$this->siniestro->domicilio_completo_google.', en adelante “EL ASEGURADO”, por la otra parte;';
		$this->x = 40;
		$this->MultiCell(150, 5, $text, $this->b, 'J', 0);
	}

	function antecedentes() {
		$this->SetFont('Arial', 'B', 9);
		$this->x = 20;
		$this->Cell(170, 5, 'ANTECEDENTES:', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 9);

		$text = 'i. SANCOR SEGUROS y EL ASEGURADO se encuentran vinculados por un contrato de seguro, identificado mediante Póliza N° '.$this->siniestro->numero_poliza.', Referencia N° '.$this->siniestro->referencia.', del ramo '.$this->siniestro->ramo->nombre.'.';
		$this->x = 20;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$text = 'ii. En el marco descrito, EL ASEGURADO denunció un siniestro en fecha '.date_format($this->siniestro->fecha_denuncia, 'd/m/Y').', el cuál ha sido identificado internamente por SANCOR SEGUROS con el N° '.$this->siniestro->numero_siniestro.'.';
		$this->x = 20;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$this->x = 20;
		$this->Cell(170, 5, 'iii. El evento denunciado es producto de otras causas.', $this->b, 1, 'L');

		$text = 'iv. Efectuada la liquidación correspondiente del referido siniestro, se concluyó que la indemnización total, única y definitiva a cargo de SANCOR SEGUROS, en favor del ASEGURADO, asciende a la suma de '.$this->siniestro->liquidacion_siniestro.' pesos .';
		$this->x = 20;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$text = 'En virtud de lo expuesto precedentemente, las partes han decidido celebrar el presente CONVENIO DE DACIÓN EN PAGO, conforme a las siguientes cláusulas:';
		$this->x = 20;
		$this->y += 3;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$text = 'PRIMERA: A los efectos de extinguir la obligación descrita en el punto iv de los ANTECEDENTES, SANCOR SEGUROS cede efectivamente en pago, en este acto y en los términos del artículo 942 del Código Civil y Comercial de la Nación, un crédito -por la suma de '.$this->siniestro->liquidacion_siniestro.' pesos - para la adquisición de bienes comercializados por la firma: Frávega, Garbarino o Musimundo.';
		$this->x = 20;
		$this->y += 3;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$text = 'SEGUNDA: Déjase expresamente aclarado y convenido entre las partes que el crédito cedido resulta plenamente exigible desde la celebración del presente, y para su ejercicio deberá utilizarse una tarjeta de compra o “voucher” que se encuentra a disposición del ASEGURADO en cualquiera de los locales comerciales que la firma indicada posee en la República Argentina.';
		$this->x = 20;
		$this->y += 3;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$text = 'TERCERA: EL ASEGURADO reconoce que el crédito cedido se encuentra sujeto a las bases y condiciones establecidas por la firma comercializadora para el uso de la tarjeta de compra o “voucher”, las que declara conocer, en especial las que se detallan a continuación: a) únicamente podrá utilizarse en locales comerciales de la firma emisora en el territorio de la República Argentina, b) no es canjeable por dinero en efectivo, c) es personal e intransferible.';
		$this->x = 20;
		$this->y += 3;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$text = 'CUARTA: EL ASEGURADO, en razón de los beneficios personales que le reporta esta operación, voluntariamente acepta en calidad de pago –total y definitivo- la prestación indicada en la cláusula PRIMERA. De este modo, EL ASEGURADO expresa que nada más tendrá que reclamar a SANCOR SEGUROS Y/O TERCERAS PERSONAS en razón del siniestro mencionado en los ANTECEDENTES, liberando de toda responsabilidad a la aseguradora por el referido evento.';
		$this->x = 20;
		$this->y += 3;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);

		$text = 'En la ciudad de ..................................., en fecha .................................... se suscribe el presente CONVENIO DE DACIÓN EN PAGO.';
		$this->x = 20;
		$this->y += 3;
		$this->MultiCell(170, 5, $text, $this->b, 'J', 0);
	}

	function firma() {
		$this->y += 3;
		$this->x = 20;
		$this->Cell(170, 10, 'FIRMA DEL ASEGURADO: .................................', $this->b, 1, 'L');
		$this->x = 20;
		$this->Cell(170, 10, 'ACLARACIÓN: .................................', $this->b, 1, 'L');
		$this->x = 20;
		$this->Cell(170, 10, 'DNI N°: .................................', $this->b, 1, 'L');
	}

}