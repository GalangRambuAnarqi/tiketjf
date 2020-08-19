<?php 
	defined('BASEPATH')or exit('no direct script access allowed');
include './application/vendor/phpqrcode/qrlib.php';
class Daftar_pdf extends CI_Controller{
		function __construct(){     
			parent:: __construct();   
			$this->load->library('PDF');
		}
		function index(){
	    	$ses 	= $this->session->userdata('ses_pendaftar');
	    	$read	= $this->DATA->data_univ($ses['lulusan']);

			$pdf = new FPDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->Image('./assets/registrasi/img/tiketJF.jpg',5,5,200);
			$pdf->Ln(70);
			$pdf->SetFont('Arial','B',14);
			$pdf->Cell(30,10,'ID Tiket',0,0,'L');
			$pdf->Cell(5,10,':',0,0,'L');
			$pdf->Cell(100,10,$this->session->userdata['id'],0,1,'L');
			$pdf->Cell(30,10,'Nama',0,0,'L');
			$pdf->Cell(5,10,':',0,0,'L');
			$pdf->Cell(100,10,$this->session->userdata['nama'],0,1,'L');
			$pdf->Cell(30,10,'Jurusan',0,0,'L');
			$pdf->Cell(5,10,':',0,0,'L');
			$pdf->Cell(100,10,$this->session->userdata['jurusan'],0,1,'L');
			$pdf->Cell(30,10,'Lulusan',0,0,'L');
			$pdf->Cell(5,10,':',0,0,'L');
			$pdf->Cell(100,10,$read[0]['Nama_univ'] ,0,1,'L');
			$pdf->Image('./assets/registrasi/img/qrcode/'.$this->session->userdata['qr'].'.png',10,258,30);
			$pdf->Output('KARTU_MASUK_JF26.pdf','I');
		}

		
		public function download(){
			$id 	= $this->input->get('id');
			$cek 	= $this->DATA->profil($id);
	    	$read	= $this->DATA->date_univ($cek[0]['lulusan']);

			$pdf = new FPDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->Image('./assets/registrasi/img/tiketJF.jpg',5,5,200);
			$pdf->Ln(70);
			$pdf->SetFont('Arial','B',14);
			$pdf->Cell(30,10,'ID Tiket',0,0,'L');
			$pdf->Cell(5,10,':',0,0,'L');
			$pdf->Cell(100,10,$cek[0]['id'],0,1,'L');
			$pdf->Cell(30,10,'Nama',0,0,'L');
			$pdf->Cell(5,10,':',0,0,'L');
			$pdf->Cell(100,10,$cek[0]['nama'],0,1,'L');
			$pdf->Cell(30,10,'Jurusan',0,0,'L');
			$pdf->Cell(5,10,':',0,0,'L');
			$pdf->Cell(100,10,$cek[0]['jurusan'],0,1,'L');
			$pdf->Cell(30,10,'Lulusan',0,0,'L');
			$pdf->Cell(5,10,':',0,0,'L');
			$pdf->Cell(100,10,$read[0]['Nama_univ'] ,0,1,'L');
			$pdf->Image('./assets/registrasi/img/qrcode/'.$cek[0]['qr_code'].'.png',10,258,30);
			$pdf->Output();
		}
	}
 ?>
