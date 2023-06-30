<?php

namespace App\Http\Controllers\Helpers;

use Carbon\Carbon;

class PdfHelper {

	function printLines($instace, $start_y) {
		// Izquierda
		$instace->Line(25, $start_y, 25, $instace->y);
		// Abajo
		$instace->Line(25, $instace->y, 185, $instace->y);
		// Derecha
		$instace->Line(185, $start_y, 185, $instace->y);
	}

	function informeLiquidadorFooter($instace) {
		$instace->y += 5;
		
		$instace->SetTextColor(0,0,0);	
		$instace->SetFont('Arial', '', 10);

		$instace->x = 25;
		$instace->Cell(80, 5, 'Scrap Free Reparaciones Sustentables', $instace->b, 1, 'L');
		
		$instace->x = 25;
		$instace->Cell(80, 5, '+54 (9) 11 2654-9045', $instace->b, 1, 'L');
		
		$instace->x = 25;
		$instace->Cell(80, 5, '+54 (9) 3444 41-9053', $instace->b, 1, 'L');
		
		$instace->x = 25;
		$instace->Cell(80, 5, 's.scrap.free@gmail.com', $instace->b, 1, 'L');
	}

	function footerScrapFree($instace, $drow_line = true, $cuit_and_address = false, $print_logo = true) {
		if ($drow_line) {
			$instace->Line(15, $instace->y, 195, $instace->y);
		}
		$instace->y += 3;
		$start_y = $instace->y;

		$instace->y += 5;	
		$instace->SetFont('Arial', 'BU', 11);
		$instace->x = 15;
		$instace->Cell(100, 5, 'Scrap Free Reparaciones Sustentables', $instace->b, 1, 'L');

		$instace->SetFont('Arial', '', 9);

		if ($cuit_and_address) {
			$instace->x = 15;
			$instace->Cell(100, 5, 'CUIT 20-24563987-3', $instace->b, 1, 'L');
			$instace->x = 15;
			$instace->Cell(100, 5, 'Larrea 716, Piso 2 Depto B, CABA', $instace->b, 1, 'L');
		}

		$instace->x = 15;
		$instace->Cell(100, 5, '+54 (9) 11 2654-9045 / +54 (9) 3444 41-9053', $instace->b, 1, 'L');
		$instace->x = 15;
		$instace->Cell(100, 5, 's.scrap.free@gmail.com', $instace->b, 1, 'L');

		if ($print_logo) {
        	$instace->Image(storage_path().'/app/public/logo.png', 170, $start_y, 25, 25);
		}
	}

	static function getBoolean($object, $prop) {
		if ($object->{$prop}) {
			return 'Si';
		}
		return 'No';
	}

	static function bienesEtiquetaEnvio($instace) {
		$instace->y += 3;
		$instace->Line(20, $instace->y, 220, $instace->y);
		$instace->y += 3;
		$x = 0;
		foreach ($instace->siniestro->bienes as $bien) {
			if ($x == 0) {
				$x = 20;
			} else if ($x != 156) {
				$x += 52;
				$instace->y -= 30;
			} else {
				$x = 20;
			}
	        $instace->x = $x;
        	$instace->SetFont('Arial', 'B', 9);
			$instace->Cell(52, 5, $bien->nombre, $instace->b, 1, 'L');
        	
        	$instace->SetFont('Arial', '', 9);
	        $instace->x = $x;
			$instace->Cell(52, 5, 'Control: '.PdfHelper::getBoolean($bien, 'tiene_control'), $instace->b, 1, 'L');

	        $instace->x = $x;
			$instace->Cell(52, 5, 'Base: '.PdfHelper::getBoolean($bien, 'tiene_base'), $instace->b, 1, 'L');

	        $instace->x = $x;
			$instace->Cell(52, 5, 'Cable: '.PdfHelper::getBoolean($bien, 'tiene_cable'), $instace->b, 1, 'L');

	        $instace->x = $x;
			$instace->Cell(52, 5, 'Cargador: '.PdfHelper::getBoolean($bien, 'tiene_cargador'), $instace->b, 1, 'L');

	        $instace->x = $x;
			$instace->Cell(52, 5, 'Accesorios: '.PdfHelper::getBoolean($bien, 'accesorios'), $instace->b, 1, 'L');
		}
	}

}