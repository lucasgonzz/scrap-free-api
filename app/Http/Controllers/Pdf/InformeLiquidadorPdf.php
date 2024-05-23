<?php

namespace App\Http\Controllers\Pdf; 

use App\Http\Controllers\Helpers\PdfHelper;
use fpdf;
require(__DIR__.'/../CommonLaravel/fpdf/fpdf.php');

class InformeLiquidadorPdf extends fpdf {

	function __construct($siniestro) {
		parent::__construct();
		$this->SetAutoPageBreak(true, 15);
		$this->b = 0;
		$this->line_height = 7;
		
		$this->siniestro = $siniestro;

		$this->AddPage();
		$this->print();
        $this->Output('I', str_replace('#', '-', $this->siniestro->numero_siniestro).' Informe Liquidador.pdf');
        exit;
	}

	function print() {
		$this->printInfo();

		$this->printTableSiniestro();

		$this->printTableLogAuditoria();

		$this->printTableFotosAsegurado();

		// $this->printTableEvidenciaTecnica();

		$this->y = 250;

		$this->Line(20, $this->y, 190, $this->y);

		PdfHelper::InformeLiquidadorFooter($this);
	}

	function printInfo() {
		$this->y = 40;
		$this->x = 25;
		$this->SetFont('Arial', 'B', 16);
		$this->Cell(75, 5, 'INFORME LIQUIDADOR', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 12);
		$this->x = 25;
		$this->Cell(75, 5, 'Scrap Free Reparaciones Sustentables', $this->b, 1, 'L');

		$this->SetFont('Arial', '', 10);
		$this->x = 25;
		$this->Cell(75, 5, 'CUIT 20-24563987-3', $this->b, 1, 'L');
		
		$this->x = 25;
		$this->Cell(75, 5, 'Larrea 716, Piso 2 Depto B, CABA', $this->b, 1, 'L');
		
		$this->x = 25;
		$this->Cell(75, 5, '+54 (9) 11 2654-9045 / +54 (9) 3444 41-9053', $this->b, 1, 'L');
		
		$this->x = 25;
		$this->Cell(75, 5, 's.scrap.free@gmail.com', $this->b, 1, 'L');

        $this->Image(storage_path().'/app/public/logo.png', 160, 40, 25, 25);

        $this->y += 5;
        $this->Line(25, $this->y, 185, $this->y);	
	}

	// -------------------------------------------
	// Tabla Siniestro
	// -------------------------------------------

	function printTableSiniestro() {
		$this->tableHeaderSiniestro();

		$this->infoSiniestro();

		$this->infoEquipos();

		$this->printInfoLines();

		$this->descripcionDelHecho();
	}

	function tableHeaderSiniestro() {
		$this->x = 25;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 12);
		$this->SetTextColor(255,255,255);
		$this->Cell(80, 7, 'Información Siniestro', $this->b, 0, 'L', 1);
		$this->Cell(80, 7, 'Información Equipo', $this->b, 1, 'L', 1);
	}

	function infoSiniestro() {
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', '', 11);

		$this->finish_y_table_header = $this->y;

		$this->y += 2;
		$this->x = 25;
		$this->Cell(80, 5, 'Fecha Reporte: '. !is_null($this->siniestro->fecha_informe_tecnico) ? $this->siniestro->fecha_informe_tecnico->format('d/m/Y') : null, $this->b, 1, 'L');

		$this->x = 25;
		$this->Cell(80, 5, 'Aseguradora:'. !is_null($this->siniestro->aseguradora) ? $this->siniestro->aseguradora->nombre : null, $this->b, 1, 'L');

		$this->x = 25;
		$this->Cell(80, 5, 'Siniestro:'. $this->siniestro->numero_siniestro, $this->b, 1, 'L');

		// $this->x = 25;
		// $this->Cell(80, 5, 'Orden Serv: '.$this->siniestro->tipo_orden_de_servicio->nombre, $this->b, 1, 'L');

		$this->x = 25;
		$this->Cell(80, 5, 'Titular: '.$this->siniestro->asegurado, $this->b, 1, 'L');

		$this->finish_y_info_siniestro = $this->y;
	}

	function infoEquipos() {
		// $this->y -= 25;
		$this->y -= 20;
		foreach ($this->siniestro->bienes as $bien) {
			$this->x = 105;
			$this->Cell(80, 5, 'Equipo: '. $bien->nombre, $this->b, 1, 'L');

			$this->x = 105;
			$this->Cell(80, 5, 'Marca: '.$bien->marca, $this->b, 1, 'L');

			$this->x = 105;
			if ($bien->id == $this->siniestro->bienes[count($this->siniestro->bienes)-1]->id) {
				$border = 0;
			} else {
				$border = 'B';
			}
			$this->Cell(80, 5, 'Numero de serie: '.$bien->numero_serie, $border, 1, 'L');

			$this->x = 105;
			$this->Cell(80, 5, 'Modelo: '.$bien->modelo, $border, 1, 'L');
		}
	}

	function printInfoLines() {
		if ($this->finish_y_info_siniestro > $this->y) {
			$this->y = $this->finish_y_info_siniestro; 
		} 

		$this->y += 2;	

		// Abajo
		$this->Line(25, $this->y, 185, $this->y);
		// Izquierda
		$this->Line(25, $this->finish_y_table_header, 25, $this->y);
		// Derecha
		$this->Line(185, $this->finish_y_table_header, 185, $this->y);
		// Centro
		$this->Line(105, $this->finish_y_table_header, 105, $this->y);
	}

	function print_data($title, $text, $width, $text_color = false) {

		if (!$text_color) {
			$this->SetTextColor(0,0,0);
		} 

		$this->x = 25;
		$this->y += 2;

		$this->SetFont('Arial', 'B', 12);
		$this->Cell($width, 5, $title, $this->b, 0, 'L', 0);

		if ($text_color) {
			$this->SetTextColor(93,143,243);
		} 

		$this->SetFont('Arial', '', 12);

		$this->MultiCell(160 - $width, 5, $text, 0, 'J', 0);
		$this->y += 2;
	}

	function descripcionDelHecho() {
		// $this->y += 5;

		$start_y = $this->y;

		$this->print_data('Descripción del hecho: ', $this->siniestro->descripcion_del_hecho, 50, true);

		$this->print_data('Lugar de ocurrencia: ', $this->siniestro->domicilio_completo_google, 50);

		$this->print_data('Detalle: ', $this->siniestro->comentarios_tecnico, 18);

		$this->print_data('Posible causa: ', $this->siniestro->posible_causa, 32);

		$this->Line(25, $this->y, 185, $this->y);
		$this->Line(25, $start_y, 25, $this->y);
		$this->Line(185, $start_y, 185, $this->y);
	}




	// -------------------------------------------
	// Table Log Auditoria y Conclucion Final
	// -------------------------------------------

	function printTableLogAuditoria() {
		$this->notaImportantes();

		$this->recomendaciones();
	}

	function notaImportantes() {
		$this->y += 5;
		$this->x = 25;
		
		$this->SetFont('Arial', 'B', 12);
		$this->SetTextColor(255,255,255);
		$this->Cell(160, 7, 'Log Auditoría', $this->b, 0, 'L', 1);
		
		$this->y += 7;
		$this->x = 25;

		$this->SetFont('Arial', '', 12);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(160, 5, $this->siniestro->notas_importantes, 1, 'L', 0);
	}

	function recomendaciones() {
		$this->y += 5;
		$this->x = 25;

		$this->SetFont('Arial', 'B', 12);
		$this->SetTextColor(255,255,255);
		$this->Cell(160, 7, 'Conclusión Final / Recomendación', $this->b, 0, 'L', 1);
		
		$this->y += 7;
		$this->x = 25;

		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', '', 12);	
		$this->MultiCell(160, 5, $this->siniestro->recomendacion, 1, 'L', 0);
	}




	// -------------------------------------------
	// Table Fotos Asegurado
	// -------------------------------------------

	function printTableFotosAsegurado() {
		$this->AddPage();

		$this->tableHeaderFotosAsegurado();
		$start_y = $this->y;

		$this->fotosAsegurado();

		// PdfHelper::printLines($this, $start_y);
	}

	function tableHeaderFotosAsegurado() {
		$this->x = 20;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 12);
		$this->SetTextColor(255,255,255);
		$this->Cell(165, 7, 'Fotos Asegurado/a', $this->b, 1, 'L', 1);
	}

	function fotosAsegurado() {
        $this->y += 2;
    	$index = 1;
    	$alto_imagen = 0;
		foreach ($this->siniestro->bienes as $bien) {
        	if (env('APP_ENV') == 'local' || count($bien->images) >= 1) {
	        	$this->x = 20;	

	        	foreach ($bien->images as $image) {

	        		if ($index % 2 != 0) {
	        			$x = 20;
	        			if ($index > 1) {
	        				// dd($index);
	        				$this->y += $alto_imagen;
	        				$this->y += 5;
	        			}
	        		} else {
	        			$x = 105;
	        		}

	        		$rutaImagen = PdfHelper::imageUrl($image);

					$dimensiones = getimagesize($rutaImagen);
					$ancho = $dimensiones[0];
					$alto = $dimensiones[1];

					// Calcular la proporción de la imagen
					$proporcion = $ancho / $alto;

					// Definir el tamaño máximo que quieres que tenga la imagen en el PDF
					$tamanoMaximo = 80; // Por ejemplo, 100 unidades en el PDF

					// Calcular las nuevas dimensiones manteniendo la proporción
					$nuevoAncho = $tamanoMaximo;
					$nuevoAlto = $tamanoMaximo / $proporcion;

					// Imprimir la imagen en el PDF con las nuevas dimensiones

		        	$this->Image($rutaImagen, $x, $this->y, $nuevoAncho, $nuevoAlto);
		        	// $this->y += 30;

		        	if ($nuevoAlto > $alto_imagen) {
		        		$alto_imagen = $nuevoAlto;
		        	}
		        	$index++;
	        	}
        	}
		}
		// $this->y = $alto_imagen;
	}


	// -------------------------------------------
	// Table Evidencia Tecnica
	// -------------------------------------------
	function printTableEvidenciaTecnica() {
		$this->AddPage();

		$this->tableHeaderEvidenciaTecnica();
		$start_y = $this->y;

		$this->evidenciaTecnica();

		PdfHelper::printLines($this, $start_y);
	}

	function tableHeaderEvidenciaTecnica() {
		$this->x = 25;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 12);
		$this->SetTextColor(255,255,255);
		$this->Cell(160, 7, 'Evidencia Técnica', $this->b, 1, 'L', 1);
	}

	function evidenciaTecnica() {
        $this->y += 2;
		foreach ($this->siniestro->bienes as $bien) {
        	if (env('APP_ENV') == 'local' || count($bien->images) >= 1) {
	        	foreach ($bien->images as $image) {
		        	$this->Image(PdfHelper::imageUrl($image), 25, $this->y, 25, 25);
		        	$this->y += 30;
	        	}
        	}
		}
	}

}