<?php

require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class Generar_Excel {
	public function __construct ($datos, $eventos) {
		$this->elaborado_por = $datos["elaborado_por"];
		$this->aprobado_por = $datos["aprobado_por"];
		$this->documento = $datos["nombre_documento"];
		$this->entidad = $datos["entidad"];
		$this->hoja = $datos["nombre_hoja"];		
		$this->fecha = DateTime::createFromFormat('d-m-Y H:i:s', $datos["fecha_creado"]);
		
		$this->tareas_principales = $eventos["tareas_principales"];
		$this->tareas_programadas = $eventos["tareas_programadas"];
		
		$this->spreadsheet = new Spreadsheet();
		$this->hoja();
	}
	
	public function hoja(){
		$this->spreadsheet->getProperties()
			->setCreator($this->elaborado_por)
			->setLastModifiedBy($this->elaborado_por)
			->setTitle("Plan de trabajo de ".$this->elaborado_por)
			->setSubject("Plan de trabajo de ".$this->elaborado_por)
			->setDescription(
				"Plan de trabajo de ".$this->elaborado_por
			)
			->setKeywords("plan trabajo")
			->setCategory("Plan Trabajo");
		$this->spreadsheet->setActiveSheetIndex(0);
		$sheet = $this->spreadsheet->getActiveSheet();
		$sheet->setTitle($this->hoja);
		$sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
	}

	public function encabezado ($valores){
		$sheet = $this->spreadsheet->getActiveSheet();
		$alphabet = range('A', 'Z');
		foreach ($valores as $cell => $value) {
			$sheet->setCellValue($cell, $value[0]);
			$font = $sheet->getStyle($cell)->getFont();
			$font->getColor()->setARGB(Color::COLOR_BLACK);
			$font->setBold(true);
			$sheet->getStyle($cell)->getAlignment()->setHorizontal('right');
			$columna = array_search($cell[0], $alphabet);
			$sheet->mergeCells(($alphabet[$columna+1]).substr($cell, 1, 2).":".($alphabet[$columna+2]).substr($cell, 1, 2));
		}
	}

	public function eventos ($inicio){
		$sheet = $this->spreadsheet->getActiveSheet();
		$alphabet = range('A', 'Z');
		$sheet->setCellValue("A".$inicio, "Tareas Principales:");
		$font = $sheet->getStyle("A".$inicio)->getFont();
		$font->getColor()->setARGB(Color::COLOR_BLACK);
		$font->setBold(true);	
		$sheet->mergeCells("A".$inicio.":"."C".$inicio);	
		for ($i = 0; $i < count($this->tareas_principales); $i++) {
			$sheet->setCellValue("A".($inicio + $i + 1), $this->tareas_principales[$i]);
			$sheet->mergeCells("A".($inicio + $i + 1).":C".($inicio + $i + 1));
		}
	}

	public function columnas_ancho ($ancho){
		$sheet = $this->spreadsheet->getActiveSheet();
		$alphabet = range('A', 'Z');
		for ($i = 0; $i < 7; $i++) {
			$sheet->getColumnDimension($alphabet[$i])->setWidth($ancho);
		}
	}

	public function dias_semanas ($fila_inicio){
		$dias_semana = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
		$alphabet = range('A', 'Z');
		$sheet = $this->spreadsheet->getActiveSheet();
		$primer_dia_semana = (int)$this->fecha->format('N') - 1;
		$dias_mes = cal_days_in_month(CAL_GREGORIAN, (int)$this->fecha->format('n'), (int)$this->fecha->format('Y'));
		for ($i = $primer_dia_semana; $i < ($dias_mes + $primer_dia_semana); $i++){
			$fila = $fila_inicio + (int)($i/7)*2;
			$sheet->setCellValue($alphabet[$i%7].$fila, $dias_semana[$i%7]." ".($i-$primer_dia_semana + 1));
			$style = $sheet->getStyle($alphabet[$i%7].$fila);
			$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('ececec');
			$style->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
			$style->getAlignment()->setHorizontal('center');
			
			$evento = !empty($this->tareas_programadas["".($i - $primer_dia_semana + 1)]) ? $this->tareas_programadas["".($i - $primer_dia_semana + 1)] : "";
			$sheet->setCellValue($alphabet[$i%7].($fila+1), $evento);
			$sheet->getRowDimension($fila + 1)->setRowHeight(200);
			$sheet->getStyle($alphabet[$i%7].($fila+1))->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
			
			$font = $sheet->getStyle($alphabet[$i%7].$fila)->getFont();
			$font->getColor()->setARGB(Color::COLOR_BLACK);
			$font->setBold(true);
			$font->setName('Arial');
			$font->setSize(8);
		}
		return $fila;
	}

	public function download (){
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->spreadsheet, "Xlsx");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'.$this->documento.'.xlsx"');
		$writer->save("php://output");
	}
}

$datos = array(
	"elaborado_por" => "Yoan Gonzalez",
	"aprobado_por" => "Pepe Mujica",
	"entidad" => "Radio Artemisa",
	"nombre_hoja" => "Plan Mes",
	"nombre_documento" => "Plan Mes",
	"fecha_creado" => "13-06-2015 23:45:52",
);
$eventos = array(
	"tareas_principales" => array(
				"Supervisar transmisión de programas en vivo",
				"Realizar chequeo de grabaciones",
			),
	"tareas_programadas" => array(
				"10" => "Descripcion evento",
			),
);

$generar = new Generar_Excel($datos, $eventos);
$inicio_tareas_principales = 5; //fila de inicio
$inicio_calendario = $inicio_tareas_principales + count($generar->tareas_principales) + 2;

$valores_encabezado = array(
			"E1" => array("Fecha:", $generar->fecha->format('N')),
			"A3" => array("Elaborado por:", $generar->elaborado_por),
			"E3" => array("Entidad:", $generar->entidad),
			"E".($generar->dias_semanas($inicio_calendario, $eventos["tareas_programadas"])+3) => array("Aprobado por:", $generar->aprobado_por)
			);
$generar->columnas_ancho(20);
$generar->encabezado($valores_encabezado);
$generar->eventos($inicio_tareas_principales);
$generar->download();

