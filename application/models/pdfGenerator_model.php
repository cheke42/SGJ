<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('assets/lib/WriteHTML.php');
require('assets/lib/html_table.php');
class PdfGenerator_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function generar($data){
		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);
		$html= $this->table($data);
		$pdf->WriteHTML($html);
		$pdf->Output();
	}

	public function tablaHeader($arreglo){
		

		$header = '<thead></tr >';
		foreach ($arreglo as $row) {
			$fila = '<td bgcolor="#dddddd" align="CENTER" width="110" height="30">' . utf8_decode($row) . '</td>';
			$header = $header . $fila;
		}
		$header = $header . "</tr></thead>";
		return $header;
	}

	private function table($data){
		return 	$this->titulo($data['titulo']);/* .
				$this->abrirTabla() 		.
				$this->tablaHeader($data['header']) 	. 
				$this->cerrarTabla();*/
	}

	private function abrirTabla(){
		return '<table border="1">';
	}

	private function cerrarTabla(){
		return "</table>";
	}

	private function titulo($titulo){
		return '<p align="center">'. utf8_decode($titulo) .'</p><br><br>';
	}

}

/* End of file pdfGenerator_model.php */
/* Location: ./application/models/pdfGenerator_model.php */