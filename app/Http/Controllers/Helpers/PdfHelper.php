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

	static function imageUrl($image) {
		if (env('APP_ENV') == 'local') {
			if (str_contains($image->image_url, 'tele2')) {
				return 'https://cdn.pixabay.com/photo/2015/02/07/20/58/tv-627876_1280.jpg';
			}
			if (str_contains($image->image_url, 'tele')) {
				return 'https://cdn.pixabay.com/photo/2015/02/07/20/58/tv-627876_1280.jpg';
				return 'https://img.freepik.com/vector-gratis/fondo-plantilla-logo_1390-55.jpg';
			}

			if (str_contains($image->image_url, 'heladera2')) {
				return 'https://cdn.pixabay.com/photo/2015/02/07/20/58/tv-627876_1280.jpg';
				return 'https://acdn.mitiendanube.com/stores/001/373/205/products/heladera-ciclica-neba-a360-360lts-con-freezer-blanca1-1a2a635fc479382ccc16879598827309-1024-1024.png';
			}
			if (str_contains($image->image_url, 'heladera')) {
				return 'https://cdn.pixabay.com/photo/2015/02/07/20/58/tv-627876_1280.jpg';
				return 'https://static.cotodigital3.com.ar/sitios/fotos/full/00235600/00235659.jpg?3.0.165';
			}

			if (str_contains($image->image_url, 'licuadora2')) {
				return 'https://cdn.pixabay.com/photo/2015/02/07/20/58/tv-627876_1280.jpg';
				return 'https://http2.mlstatic.com/D_NQ_NP_926061-MLU73028445004_112023-O.webp';
			}
			if (str_contains($image->image_url, 'licuadora')) {
				return 'https://cdn.pixabay.com/photo/2015/02/07/20/58/tv-627876_1280.jpg';
				return 'https://atma.com.ar/media/catalog/product/cache/c8f6a96bef9e9f64cd4973587df2520f/l/i/li8445ap.jpg';
			}
		}
		return $image->image_url;
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
				$instace->y -= 10;
			} else {
				$x = 20;
			}
	        $instace->x = $x;
        	$instace->SetFont('Arial', 'B', 9);
			$instace->Cell(52, 5, $bien->nombre, $instace->b, 1, 'L');
        	
        	$instace->SetFont('Arial', '', 9);
	        $instace->x = $x;
			$instace->Cell(52, 5, 'Marca: '.$bien->marca, $instace->b, 1, 'L');
		}
	}

}