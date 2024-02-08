<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\CommonLaravel\Helpers\Numbers;
use App\Http\Controllers\Helpers\LiquidacionAdministrativaHelperPdf;
use App\Models\Amortizacion;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class LiquidacionAdministrativaPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct('L', 'mm', [520, 500]);
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;
		$this->liquidacion_administrativa = $siniestro->liquidacion_administrativa;

		$this->SetFillColor(150,150,150);

		$this->start_x = 40;

		$this->valor_w = 35;
		$this->text_w = 90;

		$this->height = 7;

		$this->AddPage();

		$this->body();

		// Aca se hace el recuadro formal para el gestor
		$liquidacion_administrativa_helper_pdf = new LiquidacionAdministrativaHelperPdf($this, $siniestro);
		$liquidacion_administrativa_helper_pdf->print();

        $this->Output('I', str_replace('#', '-', $this->siniestro->numero_siniestro).' Liquidacion Administrativa.pdf');
        exit;
	}


	function body() {
		$this->amortizaciones();

		$this->bienes();

		$this->bienes_imagenes_estudio_mercado();
	}

	function amortizaciones() {
		$this->SetFont('Arial', 'b', 12);
		
		$this->y = 5;
		$this->x = 5;
		$this->Cell(13, $this->height, 'Años', 1, 0, 'C', 1);
		$this->Cell(17, $this->height, 'Depre', 1, 0, 'C', 1);

		$amortizaciones = Amortizacion::where('aseguradora_id', $this->siniestro->aseguradora_id)
										->get();

		$this->SetFont('Arial', '', 12);
		foreach ($amortizaciones as $amortizacion) {
			$this->y += $this->height;
			$this->x = 5;
			$this->Cell(13, $this->height, $amortizacion->anos, 1, 0, 'C');
			$this->Cell(17, $this->height, $amortizacion->depreciacion.'%', 1, 0, 'C');
		}
	}

	function bienes_imagenes_estudio_mercado() {
		if ($this->y < 231) {
			$this->y = 231;
		}
		$this->y += 20;
		$start_x = 10;
		foreach ($this->liquidacion_administrativa->bienes as $bien) {

			if (env('APP_ENV') == 'local') {
        		$this->Image('https://img.freepik.com/vector-gratis/fondo-plantilla-logo_1390-55.jpg', $start_x, $this->y, 150, 150);
        		$start_x += 160;
			} else {
				if (!is_null($bien->foto_estudio_mercado)) {
	        		$this->Image($bien->foto_estudio_mercado, $start_x, $this->y, 150, 150);
				}
			}
        	// $index++;
		}

	}

	function bienes() {
		
		$this->y = 5;
		
		foreach ($this->liquidacion_administrativa->bienes as $bien) {
			$this->SetTextColor(0,0,0);
			
			$this->info_bien($bien);

			$this->info_coberturas_aplicadas($bien);

			$this->indemnizacion($bien);
		}

	}

	function info_bien($bien) {
			
		$this->SetFillColor(150,150,150);
		$this->SetFont('Arial', 'b', 12);

		$this->x = $this->start_x;
		$this->Cell($this->valor_w, $this->height, 'Valor', 1, 0, 'C', 1);
		$this->Cell($this->text_w, $this->height, $bien->nombre, 1, 0, 'C', 1);


		$this->SetFont('Arial', '', 12);
		$this->x = $this->start_x;
		$this->y += $this->height;
		$this->Cell($this->valor_w, $this->height, $bien->pivot->anos_antiguedad, 0, 0, 'C');
		$this->Cell($this->text_w, $this->height, 'Antiguedad al momento reporte', 0, 0, 'L');


		$this->x = $this->start_x;
		$this->y += $this->height;
		$this->Cell($this->valor_w, $this->height, $bien->pivot->procentage_depreciacion.'%', 0, 0, 'C');
		$this->Cell($this->text_w, $this->height, 'Amortizacion a aplicar', 0, 0, 'L');


		$this->x = $this->start_x;
		$this->y += $this->height;
		$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->pivot->valor_depreciado), 0, 0, 'C');
		$this->Cell($this->text_w, $this->height, 'Suma asegurada depreciada', 0, 0, 'L');


		$start_x =  $this->start_x + $this->valor_w + $this->text_w + 10; 
		$this->x = $start_x;
		$this->y -= 10;
		$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->valor_reposicion_a_nuevo), 1, 0, 'C');
		$this->Cell(50, $this->height, 'Valor a Nuevo', 1, 0, 'L');


		$this->x = $start_x;
		$this->y += $this->height;
		$this->Cell($this->valor_w, $this->height, $bien->fecha_compra->format('d/m/Y'), 1, 0, 'C');
		$this->Cell(50, $this->height, 'Fecha Compra', 1, 0, 'L');


		$this->x = $start_x;
		$this->y += $this->height;
		$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->valor_reparacion), 1, 0, 'C');
		$this->Cell(50, $this->height, 'Valor Reparacion', 1, 0, 'L');

		$this->ratio_reparacion($bien, $start_x);

	}

	function ratio_reparacion($bien, $start_x) {
		if (!is_null($bien->valor_reparacion) && $bien->usar_el_valor_de_reparacion == 1) {
			$this->y += $this->height + $this->height;
			$this->x = $start_x;


			$this->Cell(50, $this->height, 'Ratio Rep / Liquidacion', 1, 0, 'L');
			$this->Cell($this->valor_w, $this->height, number_format($bien->valor_reparacion / $bien->pivot->indemnizacion, 2) .'%', 1, 0, 'C');

			$this->y -= $this->height + $this->height;

		}
	}

	function info_coberturas_aplicadas($bien) {

		$index = 1;
		$this->x = $this->start_x;
		$this->y += $this->height;

		$this->Cell($this->text_w, $this->height, 'Coberturas', 0, 0, 'L');
		foreach ($bien->coberturas_aplicadas as $cobertura_aplicada) {

			if ($index > 1) {
				$this->x = $this->start_x;
				$this->y += $this->height + $this->height;
				$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($cobertura_aplicada->pivot->remanente_a_cubrir), 1, 0, 'C');
				$this->Cell($this->text_w, $this->height, 'Remanente a cubrir', 1, 0, 'L');
			}

			$this->SetTextColor(93,143,243);
			$this->x = $this->start_x;
			$this->y += $this->height;
			$this->Cell($this->valor_w, $this->height, $cobertura_aplicada->pivot->deducible.'%', 1, 0, 'C');
			$this->Cell($this->text_w, $this->height, 'Deducible Cobertura '.$index.' (A cargo Asegurado)', 1, 0, 'L');
			$this->SetTextColor(0,0,0);
			

			$this->x = $this->start_x;
			$this->y += $this->height;
			$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($cobertura_aplicada->pivot->deducible_aplicado), 1, 0, 'C');
			$this->Cell($this->text_w, $this->height, 'Perdida luego aplicar deducible Cobertura '.$index, 1, 0, 'L');



			$this->SetFillColor(40,173,19);
			$this->x = $this->start_x;
			$this->y += $this->height;
			$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($cobertura_aplicada->pivot->fondos), 1, 0, 'C', 1);
			$this->Cell($this->text_w, $this->height, 'Cobertura '.$index, 1, 0, 'L');

			$index++;
		}
	}

	function indemnizacion($bien) {

		$this->x = $this->start_x;
		$this->y += $this->height;

		$this->SetFont('Arial', 'b', 12);
		$this->SetTextColor(202,46,46);
		
		$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->pivot->indemnizacion), 1, 0, 'C');
		$this->Cell($this->text_w, $this->height, 'Indemnizacion asegurado', 1, 0, 'L');
		
		$this->y += $this->height + $this->height;
	}


}