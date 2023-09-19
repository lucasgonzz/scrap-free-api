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
        $this->Output();
        exit;
	}

	function print() {
		$this->printInfo();

		$this->printTableSiniestro();

		$this->printTableLogAuditoria();

		$this->printTableFotosAsegurado();

		$this->printTableEvidenciaTecnica();

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
		$this->Cell(80, 5, 'Fecha Reporte:', $this->b, 1, 'L');

		$this->x = 25;
		$this->Cell(80, 5, 'Aseguradora:'. $this->siniestro->aseguradora->nombre, $this->b, 1, 'L');

		$this->x = 25;
		$this->Cell(80, 5, 'Siniestro:'. $this->siniestro->numero_siniestro, $this->b, 1, 'L');

		$this->x = 25;
		$this->Cell(80, 5, 'Orden Serv: '.$this->siniestro->tipo_orden_de_servicio->nombre, $this->b, 1, 'L');

		$this->x = 25;
		$this->Cell(80, 5, 'Titular: '.$this->siniestro->asegurado, $this->b, 1, 'L');

		$this->finish_y_info_siniestro = $this->y;
	}

	function infoEquipos() {
		$this->y -= 25;
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
			$this->Cell(80, 5, 'IMEI: '.$bien->numero_serie, $border, 1, 'L');
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

	function descripcionDelHecho() {
		// $this->y += 5;
		$this->x = 25;

		$start_y = $this->y;
		$this->y += 2;
		$text = 'Descripción del hecho: '.$this->siniestro->descripcion_del_hecho;

		$this->MultiCell(160, 5, $text, 0, 'J', 0);
		$this->y += 2;

		$this->x = 25;
		$this->MultiCell(160, 5, 'Lugar de ocurrencia: '.$this->siniestro->domicilio_completo_google, 0, 'J', 0);
		
		$this->x = 25;
		$this->Cell(80, 5, 'Detalle: ', $this->b, 1, 'L');
		
		$this->x = 25;
		$this->Cell(80, 5, 'Posible causa: ', $this->b, 1, 'L');

		$this->Line(25, $this->y, 185, $this->y);
		$this->Line(25, $start_y, 25, $this->y);
		$this->Line(185, $start_y, 185, $this->y);
	}




	// -------------------------------------------
	// Table Log Auditoria y Conclucion Final
	// -------------------------------------------

	function printTableLogAuditoria() {

		$this->tableHeaderLogAuditoria();

		$this->recomendaciones();

		$this->notaImportantes();
	}

	function tableHeaderLogAuditoria() {
		$this->x = 25;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 12);
		$this->SetTextColor(255,255,255);
		$this->Cell(80, 7, 'Log Auditoría', $this->b, 0, 'L', 1);
		$this->Cell(80, 7, 'Conclusión Final / Recomendación', $this->b, 1, 'L', 1);
	}

	function notaImportantes() {
		$this->y = $this->start_y_recomendacion;
		$this->x = 25;
		$this->MultiCell(80, 5, $this->siniestro->notas_importantes, 1, 'L', 0);

		// foreach ($this->siniestro->nota_importantes as $nota_importante) {
		// 	$this->x = 25;
		// 	$fecha = date_format($nota_importante->created_at, 'd/m');
		// 	$this->MultiCell(80, 5, $fecha.' '.$nota_importante->nota, 1, 'L', 0);
		// }
	}

	function recomendaciones() {
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial', '', 12);	
		$this->x = 105;
		$this->start_y_recomendacion = $this->y;
		$this->MultiCell(80, 5, $this->siniestro->recomendacion, 1, 'L', 0);
	}




	// -------------------------------------------
	// Table Fotos Asegurado
	// -------------------------------------------

	function printTableFotosAsegurado() {
		$this->AddPage();

		$this->tableHeaderFotosAsegurado();
		$start_y = $this->y;

		$this->fotosAsegurado();

		PdfHelper::printLines($this, $start_y);
	}

	function tableHeaderFotosAsegurado() {
		$this->x = 25;
		$this->y += 5;
		$this->SetFont('Arial', 'B', 12);
		$this->SetTextColor(255,255,255);
		$this->Cell(160, 7, 'Fotos Asegurado/a', $this->b, 1, 'L', 1);
	}

	function fotosAsegurado() {
        $this->y += 2;
		foreach ($this->siniestro->bienes as $bien) {
        	if (env('APP_ENV') == 'local' || !is_null($bien->foto_frente_asegurado)) {
	        	$this->x = 25;	
	        	$this->Image($this->imageUrl($bien, 'foto_frente_asegurado'), 25, $this->y, 25, 25);
	        	$this->y += 30;
        	}
		}
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
        	if (env('APP_ENV') == 'local' || !is_null($bien->foto_evidencia_scrap_free)) {
	        	$this->Image($this->imageUrl($bien, 'foto_evidencia_scrap_free'), 25, $this->y, 25, 25);
	        	$this->y += 30;
        	}
		}
	}


	function imageUrl($bien, $prop) {
		if (env('APP_ENV') == 'local') {
			return 'https://multipoint.com.ar/Image/0/750_750-Nuevo_proyecto_-_2021-10-28T141946.141.jpg';
		}
		return $bien->{$prop};
	}

}