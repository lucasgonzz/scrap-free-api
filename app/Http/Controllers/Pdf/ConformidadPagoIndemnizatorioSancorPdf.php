<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\Helpers\PdfHelper;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class ConformidadPagoIndemnizatorioSancorPdf extends fpdf {

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

	function Header() {
		$this->SetFont('Arial', 'B', 14);
		$this->SetTextColor(167, 30, 111);
		$text = 'CONFORMIDAD PAGO INDEMNIZATORIO';
		$this->y = 25;
		$this->x = 15;
		$this->MultiCell(70, 5, $text, $this->b, 'L', 0);


		$this->SetFont('Arial', 'U', 11);
		$this->SetTextColor(5, 99, 193);

        $this->x = 15;
		$this->Cell(100, 5, 'www.gruposancorseguros.com', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 11);
		$this->SetTextColor(0, 0, 0);

        $this->x = 15;
		$this->Cell(100, 5, 'Ruta Nacional 34 km 257 - 2322 - Sunchales - Santa Fe', $this->b, 1, 'L');

        $this->Image(storage_path().'/app/public/sancor_75_anos.jpg', 120, 20, 75, 25);

        $this->y += 3;
        $this->Line(15, $this->y, 195, $this->y);

	}

	function body() {
		$this->y +=3;
		$text = $this->siniestro->asegurado->nombre.', DNI '.$this->siniestro->asegurado->numero_documento.', por medio de la presente, en mi carácter de asegurado, en virtud del contrato de seguro Hogar Individual, individualizado bajo la póliza N° '.$this->siniestro->poliza->numero_poliza.', referencia N° '.$this->siniestro->poliza->referencia.', ACEPTO percibir el monto indemnizatorio determinado por Sancor Cooperativa de Seguros Limitada, fijado en la suma de , en concepto de único pago indemnizatorio, total y definitivo, cancelatorio de todas las obligaciones emergentes del contrato de seguro antes individualizado, en relación con el siniestro número '.$this->siniestro->numero_siniestro.', denunciado el día '.date_format($this->siniestro->fecha_denuncia, 'd/m/Y').' como ocurrido el día '.date_format($this->siniestro->fecha_ocurrencia, 'd/m/Y').', producto de otras causas, ocurrido en '.$this->siniestro->domicilio_completo_google.'.';
		$this->x = 15;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$text = 'Además, declaro no poseer otro seguro vigente que ampare los bienes afectados a indemnizar producto del siniestro enunciado precedentemente.';
		$this->y += 3;
		$this->x = 15;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$text = 'Asimismo, acepto que el referido pago indemnizatorio sea efectivizado dentro de los 15 (quince) días de la firma del presente, a través de transferencia bancaria a la cuenta:';
		$this->y += 3;
		$this->x = 15;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$this->y += 3;
		$this->x = 15;
		$this->Cell(100, 7, 'Titular: .............................................................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(100, 7, 'Banco: .............................................................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(100, 7, 'Sucursal: .........................................................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(100, 7, 'Tipo y N° de cuenta: .......................................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(100, 7, 'N° CBU: ..........................................................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(100, 7, 'CUIT N°: .........................................................................', $this->b, 1, 'L');

		$text = 'Hago constar que una vez recibido el importe mencionado anteriormente me consideraré amplia y totalmente indemnizado por todo concepto y por todos los rubros reclamados y reclamables, y por todas las consecuencias derivadas del evento mencionado anteriormente, como así también por cualquier concepto originado en el siniestro, renunciando a cualquier acción contra Sancor Cooperativa de Seguros Limitada. Asimismo, manifiesto mi conformidad de ceder a Sancor Cooperativa de Seguros Limitada la propiedad de los restos y/o rezagos del/los bien/es afectado/s en el mencionado siniestro, para que dicha compañía disponga el destino que estime pertinente sobre el/los mismo/s.';

		$this->y += 3;
		$this->x = 15;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$text = 'Finalmente, manifiesto que, una vez que Sancor Cooperativa de Seguros Limitada efectúe la referida transferencia, se producirán plenos efectos cancelatorios, y nada más tendré que reclamar de Sancor Cooperativa de Seguros Limitada, liberándola de toda responsabilidad por el asunto de la referencia, incluso por la imposibilidad de extraer las sumas que se acrediten en la referida cuenta por causas que no le sean imputables';

		$this->y += 3;
		$this->x = 15;
		$this->MultiCell(180, 5, $text, $this->b, 'J', 0);

		$this->y += 3;
		$this->x = 15;
		$this->Cell(100, 7, 'Firma: ..............................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(100, 7, 'Aclaración: ......................................', $this->b, 1, 'L');
		$this->x = 15;
		$this->Cell(100, 7, 'En: ................................... a los ........... días del mes de .............. de '.date('Y'), $this->b, 1, 'L');

		$this->y += 3;
	}

	function Footer() {
		PdfHelper::footerScrapFree($this);
	}

}