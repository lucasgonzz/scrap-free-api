<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\CommonLaravel\Helpers\Numbers;
use App\Http\Controllers\Helpers\LiquidacionAdministrativaHelperPdf;
use App\Models\Amortizacion;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class LiquidacionAdministrativaPdf extends fpdf {

	function __construct($siniestro) {
		$this->siniestro = $siniestro;
		$this->liquidacion_administrativa = $siniestro->liquidacion_administrativa;
		$this->set_cantidad_de_fotos();

		parent::__construct('L', 'mm', [520, $this->getPdfHeight()]);
		$this->SetAutoPageBreak(true, 1);
		$this->b = 0;
		$this->line_height = 7;
		

		$this->SetFillColor(150,150,150);

		$this->start_x = 40;

		$this->valor_w = 35;
		$this->text_w = 90;

		$this->height = 7;

		$this->AddPage();

		$this->body();

        $this->Output('I', str_replace('#', '-', $this->siniestro->numero_siniestro).' Liquidacion Administrativa.pdf');
        exit;
	}

	function getPdfHeight() {
		if ($this->cantidad_fotos < 3 || $this->siniestro->cantidad_bienes >= 3) {
			return 500;
		}
		return 300;
	}


	function body() {
		// Aca se hace el recuadro formal para el gestor
		$liquidacion_administrativa_helper_pdf = new LiquidacionAdministrativaHelperPdf($this, $this->siniestro);
		$liquidacion_administrativa_helper_pdf->print();

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

	function set_cantidad_de_fotos() {
		$this->cantidad_fotos = 0;
		foreach ($this->liquidacion_administrativa->bienes as $bien) {
			foreach ($bien->foto_estudio_mercado as $foto) {
				$this->cantidad_fotos++;
			}
		}
		return $this->cantidad_fotos;
	}

	function bienes_imagenes_estudio_mercado() {
		// if ($this->siniestro->cantidad_bienes > 2 && $this->y < 231) {
		// dd($this->y);
		// if ($this->y < 231) {
		// 	$this->y = 231;
		// }

		if ($this->liquidacion_gestor_finish_y > $this->y) {
			$this->y = $this->liquidacion_gestor_finish_y;
		} 

		$start_x = 10;
		
		if ($this->cantidad_fotos > 2) {

			$this->AddPage('L', [520, 500]);

			$this->y = 10;

		} else {
			$this->y += 20;
		}

		$index = 1;


		foreach ($this->liquidacion_administrativa->bienes as $bien) {
			foreach ($bien->foto_estudio_mercado as $foto) {
				$image = null;
				if (env('APP_ENV') == 'local') {
					// $image = 'https://cdn.pixabay.com/photo/2015/07/17/22/42/startup-849804_1280.jpg';
					// $image = null;
					$image = 'https://api.scrapfree.com.ar/public/storage/1708364064930.jpg';

				} else {
		        	$image = $foto->image_url;
				}

				if (!is_null($image)) {
					$dimensiones = getimagesize($image);

					$ancho_original = $dimensiones[0];
					$alto_original = $dimensiones[1];

					$nuevo_ancho = 230; 

					// Calcular el alto proporcional
					$nuevo_alto = ($nuevo_ancho * $alto_original) / $ancho_original;
					
	        		$this->Image($image, $start_x, $this->y, $nuevo_ancho, $nuevo_alto);
					
	        		if ($index == 6 || $index == 12 || $index == 18) {
	        			$this->AddPage();
	        			$this->y = 10;
	        			$start_x = 10;
	        		} else if ($index % 2 == 0) {
						$start_x -= $nuevo_ancho + 10;
						$this->y += $nuevo_alto + 20;
					} else {
						$start_x += $nuevo_ancho + 10;
					}
        			$index++;
				}
			}

        
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
		$this->y -= 13;
		$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->valor_reposicion_a_nuevo), 1, 0, 'C');
		$this->Cell(50, $this->height, 'Valor a Nuevo', 1, 0, 'L');


		$this->x = $start_x;
		$this->y += $this->height;
		$this->Cell($this->valor_w, $this->height, $bien->fecha_compra->format('d/m/Y'), 1, 0, 'C');
		$this->Cell(50, $this->height, 'Fecha Compra', 1, 0, 'L');


		$this->x = $start_x;
		$this->y += $this->height;
		$reparacion = 0;
		if ($this->usar_reparacion($bien)) {
			$reparacion = $bien->valor_reparacion;
		}
		$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($reparacion), 1, 0, 'C');
		$this->Cell(50, $this->height, 'Valor Reparacion', 1, 0, 'L');

		$this->ratio_reparacion($bien, $start_x);

	}

	function usar_reparacion($bien) {
		return !$bien->usar_el_valor_de_indemnizacion && !is_null($bien->valor_reparacion);
	}

	function ratio_reparacion($bien, $start_x) {
		if ($this->usar_reparacion($bien)) {
			$this->y += $this->height + $this->height;
			$this->x = $start_x;


			$this->Cell(50, $this->height, 'Ratio Rep / Liquidacion', 0, 0, 'L');
			$this->Cell($this->valor_w, $this->height, $bien->pivot->ratio .'%', 0, 0, 'C');

			$this->y += $this->height;
			$this->x = $start_x;

			$this->Cell(50, $this->height, 'Ahorro Sancor', 0, 0, 'L');
			$this->Cell($this->valor_w, $this->height, '$'.Numbers::price((float)$bien->pivot->indemnizacion_a_nuevo - (float)$bien->valor_reparacion), 0, 0, 'C');

			$this->y -= $this->height + $this->height;

		}
	}

	function info_coberturas_aplicadas($bien) {

		$index = 1;
		$this->x = $this->start_x;
		// $this->y += $this->height;

		// $this->Cell($this->text_w, $this->height, 'Coberturas', 0, 0, 'L');
		foreach ($bien->coberturas_aplicadas as $cobertura_aplicada) {

			if ($index > 1) {
				$this->x = $this->start_x;
				$this->y += $this->height + $this->height;
				$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($cobertura_aplicada->pivot->remanente_a_cubrir_a_nuevo), 1, 0, 'C');
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
			$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($cobertura_aplicada->pivot->fondos_a_nuevo), 1, 0, 'C', 1);
			$this->Cell($this->text_w, $this->height, 'Cobertura '.$index, 1, 0, 'L');

			$index++;
		}
	}

	function indemnizacion($bien) {

		$this->x = $this->start_x;
		$this->y += $this->height + $this->height;

		$this->SetFont('Arial', 'b', 12);
		$this->SetTextColor(93,143,243);
		
		$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->pivot->deducible_aplicado_a_nuevo), 1, 0, 'C');
		$this->Cell($this->text_w, $this->height, 'Deducible', 1, 0, 'L');

		$this->y += $this->height;
		$this->x = $this->start_x;

		$this->SetTextColor(202,46,46);
		$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->pivot->indemnizacion_a_nuevo), 1, 0, 'C');
		$this->Cell($this->text_w, $this->height, 'Indemnizacion asegurado', 1, 0, 'L');


		$x_derecha = $this->start_x + $this->valor_w + $this->text_w + 10;

		$this->x = $x_derecha;
		$this->y -= $this->height;

		if ($this->usar_reparacion($bien)) {
			$this->SetTextColor(93,143,243);
			$this->Cell($this->text_w - 40, $this->height, 'Deducible', 1, 0, 'L');
			$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->pivot->deducible_aplicado_a_reparacion), 1, 0, 'C');

			$this->y += $this->height;
			$this->x = $x_derecha;

			$this->SetTextColor(202,46,46);
			$this->Cell($this->text_w - 40, $this->height, 'Reparacion', 1, 0, 'L');
			$this->Cell($this->valor_w, $this->height, '$'.Numbers::price($bien->pivot->indemnizacion_reparacion), 1, 0, 'C');
		}
		
		$this->y += $this->height + $this->height + $this->height;
	}


}