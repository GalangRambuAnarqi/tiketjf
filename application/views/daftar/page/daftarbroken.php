
<?php 
  // membuat obyek class
  $captcha1 = new mathcaptcha();
  // panggil method untuk mengenerate kode
  $captcha1->generatekode();
  include('./application/vendor/koneksi.php');

  $id = 'JFU_26'. str_pad($this->DATA->jumlahpendaftar() + 1,5,"0",STR_PAD_LEFT);
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

     <!-- sidebar -->

     <!-- sidebar -->

        <div class="span4">
        <!-- <div style="margin:auto; width:70%; height:30%; background-color:white; padding:5%; border-radius: 10px;">
          <b>Sudah Mendaftar? Login disini</b>
        </div><br> -->
        <!-- <img src="<?php echo base_url() ?>assets/registrasi/img/list_inc.png" alt="guide"> 
      <br><br> -->

        </div>
        <div class="register span6">
          <form name="form" method="post" action="<?php echo base_url('daftar/submit'); ?>" onSubmit="return validasi(this)" role="form" enctype="multipart/form-data">
            <h2>FORMULIR <span class="red"><strong>JOBFAIR 26</strong></span></h2>
             <!--<label for="id">Nomor Tiket</label> 
             <input type="text" id="id" name="id" value="<?php echo $id; ?>" disabled> -->
            <h3>No Tiket: <strong name="id"><?php echo $id; ?></strong></h3>
            <span class="red"><h3>GOLONGAN TIKET</h3></span>
            <div class="form-group">
            <label>Golongan</label></dt>
              <div class="form-group">
                <select name="combo1" onChange="change(this);">
                  <option value="pilih">--Pilih--</option>
                  <option value="UDINUS">UDINUS (Khusus Alumni/Mahasiswa UDINUS)</option>
                  <option value="UMUM">UMUM (Untuk Umum)</option>
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

            <span class="red"><h3>DATA AKUN</h3></span>  
            <div class="form-group">   
              <label for="email">Email</label> <span id="pesan_email"></span>
              <div class="form-group">
                <input type="text" id="email" name="email" placeholder="Contoh: emailku@gmail.com (GMAIL Recommended)">
              </div>
            </div>
            <div class="form-group">   
              <label for="email">Password</label> <span id="pesan_email"></span>
              <div class="form-group">
                <input type="password" id="pass" name="pass" placeholder="Masukkan password yang mudah diingat">
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
               <span id="prodi_nim"></span>
              <div class="form-group">
                <input type="text" id="nim" name="nim" placeholder="Contoh: A11.2015.091**" style="text-transform:uppercase">
              </div>
            </div>
            <div class="form-group" id="formlulusan">
              <label for="lulusan">Tempat Pendidikan Terakhir</label>
                <div class="form-group">
                  <select class="form-control select2" name="lulusan" id="lulusan" required style="width: 100%">
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
              <font size="2" color="red" width="10"> *Bila tiket tidak masuk inbox/spam pada email anda selama 1x24 jam hubungi 085640726824 (WA)</font>    
            </div>
          </form>
        </div>
      </div>
    </div>



<!-- <div class="open-button2"><center>Sudah Daftar? <a class="btn btn-info" href="https://cc.dinus.ac.id/peserta_JF">Login</a></center></div> -->



