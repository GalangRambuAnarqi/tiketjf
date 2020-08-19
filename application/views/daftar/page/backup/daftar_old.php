<style type="text/css">
.open-button {
  background-color: purple;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 100px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 0px solid #f1f1f1;
  margin-bottom: 20px;
  z-index: 9;
  border-radius: 20px;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  border-radius: 20px;
}

</style>
<?php 
  // membuat obyek class
  $captcha1 = new mathcaptcha();
  // panggil method untuk mengenerate kode
  $captcha1->generatekode();
  include('./application/vendor/koneksi.php');

  $id = 'JFU_25'. str_pad($this->DATA->jumlahpendaftar() + 1,5,"0",STR_PAD_LEFT);
  $gaji = array(
        1000000=>"1 juta",
        2000000=>"2 juta",
        3000000=>"3 juta",
        4000000=>"4 juta",
        5000000=>"5 juta",
        6000000=>"6 juta",
        7000000=>"7 juta",
        8000000=>"8 juta",
        9000000=>"9 juta",
        10000000=>"10 juta",
        11000000=>" > 10 juta",
  );
  $frekuensi_lowongan = array(
    "1"=>"harian",
    "mingguan",
    "2 Mingguan",
    "Bulanan",
  );
 ?>
<div class="register-container container">
      <div class="row">
        <div class="iphone span4">
        <img src="<?php echo base_url() ?>assets/registrasi/img/iphone2.png" alt="guide">
        <center>
        <button class="btn btn-large btn-danger" onclick="document.location.href='http://cc.dinus.ac.id/jobfair'">Informasi Jobfair 25</button>
        </center>
        </div>
        <div class="register span6">
          <form name="form" method="post" action="<?php echo base_url('daftar/submit'); ?>" onSubmit="return validasi(this)" role="form" enctype="multipart/form-data">
            <h2>FORMULIR <span class="red"><strong>JOBFAIR 25</strong></span></h2>
             <!--<label for="id">Nomor Tiket</label> 
             <input type="text" id="id" name="id" value="<?php echo $id; ?>" disabled> -->
            <h3>No Tiket: <strong name="id"><?php echo $id; ?></strong></h3>
            <span class="red"><h3>GOLONGAN TIKET</h3></span>
            <div class="form-group">
            <label>Golongan</label></dt>
              <div class="form-group">
                <select name="combo1" onChange="change(this);">
                  <option value="pilih">--Pilih--</option>
                  <option value="UDINUS">UDINUS</option>
                  <option value="UMUM">UMUM</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>Tiket</label>
              <div class="form-group">
                <select id="sel" name="combo2" style="visibility:hidden;width:98%;">
                </select>
              </div>
            </div>


            <span class="red"><h3>DATA PRIBADI</h3></span>   
            <div class="form-group">        
              <label for="nama">Nama Lengkap</label>
              <div class="form-group">
                <input type="text" id="nama" name="nama" placeholder="Contoh: Career Center Udinus">
              </div>
            </div>
            <div class="form-group">   
              <label for="email">Email</label> <span id="pesan_email"></span>
              <div class="form-group">
                <input type="text" id="email" name="email" placeholder="Contoh: emailku@gmail.com (GMAIL Recommended)">
              </div>
            </div>
            <div class="form-group">   
              <label for="hp">Nomor Handphone</label>
              <div class="form-group">
                <input type="text" id="hp" name="hp" placeholder="Contoh: 0858684*****">
              </div>
            </div>
            <div class="form-group">  
              <label for="alamat">Alamat Lengkap</label>
              <div class="form-group">
                <input type="text" id="alamat" name="alamat" placeholder="Contoh: Jl. imam bonjol">
              </div>
            </div>

            <span class="red"><h3>DATA PENDIDIKAN</h3></span>
            <div class="form-group"> 
              <label for="nim">NIM / Nomor Induk Mahasiswa: (Khusus Alumni UDINUS)</label>
              <div class="form-group">
                <input type="text" id="nim" name="nim" placeholder="Contoh: A11.2015.091**" style="text-transform:uppercase">
              </div>
            </div>
            <div class="form-group">
              <label for="lulusan">Tempat Pendidikan Terakhir</label>
                <div class="form-group">
                  <select class="form-control select2" name="lulusan" required style="width: 100%">
                    <option value="0">- Pilih Salah Satu Universitas / SMU -</option>
                    <?php 
                      foreach ($this->DATA->get_univ() as $univ) {?>
                        <option value="<?=$univ['id'];?>"><?=$univ['nama_univ'];?></option>
                      <?php } ?>
                  </select>
                  <label>Ex Tempat Pendidikan Terakhir : <br>
                    1. jika data universitas tidak ada, <strong>PILIH PERGURUAN TINGGI LAINNYA</strong><br>
                    2. Jika lulusan <strong>SMA, PILIH SMA</strong> dan jika lulusan <strong> SMK, PILIH SMK</strong>
                  </label>
              </div>
             </div>
            <div class="form-group"> 
              <label for="ipk">IPK</label>
              <div class="form-group">
                <input type="text" id="ipk" name="ipk" placeholder="Contoh: 4.0">
                  <label>Ex IPK : Jika dari <strong>SMA / SMK</strong> masukan <strong>Rata-rata Nilai Ujian Nasional</strong>
                  </label>
              </div>
            </div>
            <div class="form-group"> 
              <label>Jenjang Pendidikan Terakhir</label>
              <div class="form-group">
                <select name="jenjang">
                <option value="pilih" selected disabled>--Pilih--</option>
                <option value="SMU/SMK">SMU/SMK</option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option><select>
              </div>
            </div>
            <div class="form-group"> 
              <label for="jurusan">Jurusan / Program Studi</label>
              <div class="form-group">
                <input type="text" id="jurusan" name="jurusan" placeholder="Contoh: Teknik Informatika">
              </div>
            </div>
              <label for="spesialisasi"> Spesialisasi <b><small><font color="red">Silahkan pilih max 3 spesialisasi</font></small></b></label>
            
            <div class="row">
              <div class="pricing-levels-3">
                <?php
                  $query2    = mysqli_query($conn,"select * from spesialisJF17 order by id");
                  while($row = mysqli_fetch_object($query2)){
                ?>
                  <input class="single-checkbox" type="checkbox" name="sp[]" value="<?= $row->id; ?>"> 
                  &nbsp;&nbsp;<?= $row->nama; ?><br />
                <?php
                  }
                ?>
              </div>
            </div>
            <div class="form-group">            
            <label for="spesialisasi"> Gaji yang Diinginkan</label>
              <div class="form-group">
                <select name="gaji">
                <option value="0">Pilih</option>
                <?php
                  foreach($gaji as $key=>$value){
                    echo "<option value='". $key . "'>" . $value . "</option>";
                  }
                ?>  
                </select>
              </div>
            </div>
            <div class="form-group">
            <label for="spesialisasi"> Frekuensi Menerima Informasi Lowongan</label>
              <div class="form-group">
                <select name="frekuensi">
                <option value="0">Pilih</option>
                <?php
                  foreach($frekuensi_lowongan as $key=>$value){
                    echo "<option value='". $key . "'>" . $value . "</option>";
                  }
                ?>  
                </select>
              </div>
            </div>
            <div class="form-group">
            <label for="kode"><b>Kode Verifikasi</b></label>   
              <div class="form-group">        
                <?php
                  // menampilkan kode captcha berisi soal matematika
                  $captcha1->showcaptcha();
                ?>
            <a href ="" onClick="window.location.reload">coba soal lain</a>
              </div>
            </div>
            <div class="form-group">
              <input type="text" name="kode" id="kode" name="kode"required="">
            </div>
            </p>
            <button class="btn btn-large btn-danger" type="submit">Daftar</button>
                  <div class="form-group">
              <font size="2" color="red" width="10"> *Bila tiket tidak masuk inbox/spam pada email anda datang langsung saja ke UDINUS untuk mendapatkan tiket</font>    
            </div>
          </form>
        </div>
      </div>
    </div>


<button class="open-button" onclick="openForm()"><b>Lapor Masalah</button>

<div class="chat-popup" id="myForm">
  <div class="form-container">
   <center> 
    <!-- <h4>085640726825 <br>(Whatsapp)</h4> -->
    <h4>Untuk Pendaftaran&Tiket bisa<br>Langsung ke UDINUS</h4>
  <button onclick="closeForm()">Close</button>
</center>
  </div>
</div>


    <script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>