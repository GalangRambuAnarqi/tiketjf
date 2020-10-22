<?php
	class Databases extends CI_Model{
        
        function __construct(){
            parent::__construct();
            $this->load->database();
        }
        /*PENDAFTARAN JOBFAIR*/
        public function get_univ(){
            $query = $this->db->query('SELECT * FROM daftar_univ order by id');
            return $query->result_array();
        }

        public function cek_email($email){
            $jfke=$this->getjfke();
            $idjf=$jfke->id;

            // $regid=$this->getRowBy('registrasiJF',array('email'=>$email))->iduser;
       
            // $this->db->where('email', $email);  
            // $this->db->where('jf_id', $idjf);  
            // $query = $this->db->get("registrasiJF")->num_rows();
            // return $query;

            $this->db->select('a.*');
            $this->db->from('registrasiJF a');
            $this->db->join('partisipasi_JF b', 'b.id_registrasi = a.iduser', 'left'); 
            $this->db->where('a.email', $email);  
            $this->db->where('b.id_jf', $idjf);  
            $query = $this->db->get();
            return $query->num_rows();
        }

        function getRowBy($tb,$where){
            return $this->db->select('*')
            ->from($tb)
            ->where($where)
            ->get()->row();
        }

        function getLastId(){
            return $this->db->select('iduser')
                    ->from('registrasiJF')
                    ->order_by('iduser','DESC')
                    ->get()->row()->iduser;
        }

        public function cek_nim($nim){
            $this->db->where('kd_prodi', $nim);  
            $query = $this->db->get("prodi")->num_rows();
            return $query;
        }


        function jumlahpendaftar($jfid){
            $this->db->select("id");
            $this->db->from("registrasiJF");
            $this->db->where("jf_id",$jfid);
            $read =  $this->db->get()->result_array();
            return count($read);
        }

        function create($tabel,$create){
            $this->db->insert($tabel, $create);
            return $this->db->insert_id();
        }
        
        function getSpesialisasi(){
            return $this->db->get('spesialisJF17')->result_array();
        }

        public function newID(){
            $conn = mysqli_connect("cc.dinus.ac.id","cc","AlphardGanteng","cc_tiket_jobfair");
            $query = "SELECT max(id) as maxID FROM registrasiJF";
            $hasil = mysqli_query($conn,$query);
            $data  = mysqli_fetch_array($hasil);
            $idMax = $data['maxID'];
            $noUrut = (int) substr($idMax, 6, 10);
            $noUrut++;
            $id = 'VJF_01' . sprintf("%05s", $noUrut);
            return $id;
        }

        public function insertspe($table,$data){
            return $this->db->insert($table,$data);
        }

        public function data_univ($lulusan){
            $this->db->select("b.nama_univ as Nama_univ");
            $this->db->from("daftar_univ as b");
            $this->db->where('a.lulusan', $this->session->userdata('lulusan'));
            $this->db->join('registrasiJF as a', 'b.id = a.lulusan', 'inner');
            return $this->db->get()->result_array();
        }

        public function profil($id){
            $this->db->select("*");
            $this->db->from("registrasiJF");
            $this->db->where("id = '$id'");
            return $this->db->get()->result_array();
        }

        public function date_univ($lulusan){
            $this->db->select("b.nama_univ as Nama_univ");
            $this->db->from("daftar_univ as b");
            $this->db->where('a.lulusan', $lulusan);
            $this->db->join('registrasiJF as a', 'b.id = a.lulusan', 'inner');
            return $this->db->get()->result_array();
        }

        public function getjfke(){
            return $this->db->select("*")
                     ->from("jf_ke")
                     ->order_by('id','DESC')
                     ->get()->row();
        }

        //PESERTA

        public function GetWhere($table,$where){
            return $this->db->get_where($table,$where);
        }

        public function getPerusahaan(){
            $where=array(
                'status'=>'aktif'
            );
            return $this->db->get_where('perusahaan_JF',$where)->result_array();
        }

        public function update_data($table,$set,$where){
            $this->db->set($set)
                     ->where($where)
                     ->update($table);
        }


        //END OF PESERTA
        
    }
?>