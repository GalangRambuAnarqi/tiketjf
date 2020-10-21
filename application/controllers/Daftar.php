<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
include './application/vendor/class-captcha.php';
include './application/vendor/phpqrcode/qrlib.php';
include './application/vendor/PDF.php';
  $captcha1 = new mathcaptcha();
  $captcha1->generatekode();

class Daftar extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper('tgl_indo');
		error_reporting(0);
	}
	
	public function index()
	{
		$data['jfke']=$this->DATA->getjfke();
		$data['content']['univ'] 	= $this->DATA->get_univ();
		$data['perusahaan'] = $this->DATA->getPerusahaan();
		$data['page']       		= "daftar";
		$data['daftar_univ']  		= $this->DATA->get_univ();
		$data['jml_pelamar']		= $this->DATA->jumlahpendaftar($data['jfke']->id);
		$data['spesialisasi']		= $this->DATA->getSpesialisasi();
		$this->load->view('daftar/layout.php',$data);
	}

	function submit(){
		$this->form_validation->set_rules('combo1','combo1','required');
		$this->form_validation->set_rules('nama','nama','required');
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('pass','pass','required');
		$this->form_validation->set_rules('hp','hp','required');
		$this->form_validation->set_rules('alamat','alamat','required');
		$this->form_validation->set_rules('nim','nim');
		$this->form_validation->set_rules('lulusan','lulusan','required');
		$this->form_validation->set_rules('ipk','ipk','required');
		$this->form_validation->set_rules('jenjang','jenjang','required');
		$this->form_validation->set_rules('jurusan','jurusan','required');
		$this->form_validation->set_rules('gaji','gaji','required');
		$this->form_validation->set_rules('frekuensi','frekuensi','required');

		$regid=$this->input->post('idjf');
		if($this->form_validation->run() !=false){
			$captcha1 	= new mathcaptcha();
			$spesialis = $this->input->post('sp');
			foreach ($spesialis as $value) {
				$data = array(
					'spesialis_id' => (implode(',',(array)$value)),
					'registrasi_id' => $regid
				);
				$this->DATA->insertspe('detail_spesialisasiJF',$data);
			}
			if($captcha1->resultcaptcha() == $_POST['kode']){
				$create['golongan']			= $this->input->post('combo1');
				$create['nama']				= $this->input->post('nama');
				$create['email']			= $this->input->post('email');
				$create['pass']				= md5($this->input->post('pass'));
				$create['hp']				= $this->input->post('hp');
				$create['alamat']			= $this->input->post('alamat');
				$create['nim']				= strtoupper($this->input->post('nim'));
				
				if($this->input->post('combo1')=='UDINUS'){
					$create['lulusan']			= '1';
				}else {
					$create['lulusan']			= $this->input->post('lulusan');
				}

				$create['ipk']				= $this->input->post('ipk');
				$create['jenjang']			= $this->input->post('jenjang');
				$create['jurusan']			= $this->input->post('jurusan');
				$create['tanggal']			= date('Y-m-d H:i:s');
				$create['gaji']				= $this->input->post('gaji');
				$create['info_lowongan']	= $this->input->post('frekuensi');
				// $qr = '';
			    // foreach($create as $c){
			    // 	$qr = $qr.$c;
			    // }
			    $create['qr_code'] = '';
				// 	QRcode::png($create['qr_code'], './assets/registrasi/img/qrcode/'.$create['qr_code'].'.png', 'H', 4, 2);
				// 	$config['max_size']     	= 1024000;
				// 	$config['overwrite']			= true;
				// 	$this->upload->initialize($config); 
				$create['id'] = $regid;
				$create['jf_id'] = $this->input->post('jf_id');

				$this->DATA->create('registrasiJF',$create);
				$data_session = array(
					'id' 		=> $create['id'],
					'nama' 		=> $create['nama'],
					'jurusan' 	=> $create['jurusan'],
					'lulusan'  	=> $create['lulusan'],
					// 'qr'		=> $create['qr_code']
				);
				if ($create['id']) {
					$this->session->set_userdata('ses_pendaftar',$data_session);
				}
				?>
				<script>
				window.alert('Registrasi sukses, silahkan login di https://cc.dinus.ac.id/peserta_JF untuk mengikuti jobfair');
				window.location.href = 'http://localhost/peserta_JF';
				</script>
				<?php
				$pwd=$this->input->post('pass');
			   // kirim email dg attachment file PDF bukti registrasi
			   $this->kirimEmail($create['email'],$create['nama'],$pwd);
			}else{
				// jika kode captcha salah
				echo "<script>window.alert('Maaf, Proses Pendaftaran Gagal. Silakan ulangi kembali.')</script>";
				redirect('Daftar','refresh');
			}		
		}
	}

	function cek_email(){ 
        if($this->DATA->cek_email($_POST["email"]) > 0){  
			echo 'Terdaftar';
        }else{  
            echo '<label class="text-success"><img src="assets/registrasi/img/tick.png">Email siap didaftarkan</label>';  
        }  
	}


		function cek_nim(){ 
			$nim=substr($_POST["nim"], 0, 3);
        if($this->DATA->cek_nim($nim) > 0){  
			echo 'ada';
        }else{  
            echo '<label class="text-success"><img src="assets/registrasi/img/cross.png">NIM tidak valid</label>';  
        }  
	}


	function get_content($url){
     $data = curl_init();
     curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($data, CURLOPT_URL, $url);
     $hasil = curl_exec($data);
     curl_close($data);
     return $hasil;
	}

	function kirimEmail($EMAIL,$NAMA,$PASS){
		$semi_rand = md5(time());
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: JOBFAIR UDINUS <career@cc.dinus.ac.id>'. "\r\n";

		$pesan = "Terimakasih Sdr.{$NAMA} telah berhasil mendaftar di Virtual Job Fair UDINUS. Untuk mengikuti jobfair silahkan login menggukanan email ({$EMAIL}) dan password ({$PASS}) di alamat cc.dinus.ac.id/peserta_JF. Semoga sukses";

		// proses mengirim email dengan attachment
		mail($EMAIL, "VIRTUAL JOB FAIR - UNIVERSITAS DIAN NUSWANTORO", $pesan, $headers);
		}
}
