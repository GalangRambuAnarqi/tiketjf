
<?php 
  // membuat obyek class
  $captcha1 = new mathcaptcha();
  // panggil method untuk mengenerate kode
  $captcha1->generatekode();
  include('./application/vendor/koneksi.php');

  $id = $jfke->kode. str_pad($jml_pelamar + 1,5,"0",STR_PAD_LEFT);
  $gaji = array(
        '3jt-5jt'=>"3 - 5 juta",
        '5jt-7jt'=>"5 - 7 juta",
        '7jt-10jt'=>"7 - 10 juta",
        '>10jt' => ">10 juta"
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
      <div class="span4 white rounded box">
        <center><h2>Informasi </h2></center>
        <hr style="border-top: 1px dashed gray">
        <!-- <img src="<?php echo base_url() ?>assets/registrasi/img/iphone2.png" alt="guide"> -->
   
        <center><span>Pelaksanaan tanggal : 
<?=mediumdate_indo($jfke->tanggal_mulai).' - '.mediumdate_indo($jfke->tanggal_selesai);?>

</span></center>
         
        <h2>Tata Cara Pendaftaran</h2>
          <!-- petunjuk -->
        <div class="list-group vertical-steps">
          <div class="list-group-item completed"><span>Isi data diri Anda dengan lengkap pada form disamping, lalu klik "Daftar".</span></div>
          <!-- <div class="list-group-item completed"><span>Cek inbox/spam email anda untuk mendownload Tiket Jobfair UDINUS. Cetak tiket dalam ukuran A4 atau A5 & tunjukkan tiket pada saat masuk area Job Fair UDINUS.</span></div> -->
          <div class="list-group-item completed"><span>Jika anda sudah mendaftar, Login ke <a href="https://cc.dinus.ac.id/peserta_JF/">Website Peserta Job Fair</a> untuk mengunggah kelengkapan dokumen pribadi & melamar ke perusahaan. </span></div>
          <!-- <div class="list-group-item completed"><span>Untuk informasi lowongan perusahaan dan posisi, terus pantau updatenya di <a href="https://www.instagram.com/udinuscareercenter/">IG Udinus Career Center</a> atau di website<a href="http://cc.dinus.ac.id/jobfair/">UDINUS JOBFAIR.</a></span></div> -->
        </div>
        
          <!-- end petunjuk -->

        <!-- <center>
        <button class="btn btn-large btn-danger" onclick="document.location.href='http://cc.dinus.ac.id/jobfair'">Informasi Jobfair 26</button>
        </center> -->
      <hr style="border-top: 1px dashed gray">
      <h2>Daftar Perusahaan</h2>
      <table id="dataTables" class="display">
      <!-- <tr><td>Coming Soon !</td></tr> -->
      <thead>
        <tr>
            <th>No</th>
            <th>Nama Perusahaan</th>
        </tr>
      </thead>
       <tbody>
        <?php
        $no=1;
         foreach($perusahaan as $data){
         ?>
         <tr>
         <td><?=$no++;?></td>
         <td><?=$data['nama']?></td>
         </tr>
         <?php
         }
        ?>
         </tbody> 
        </table>
              <!-- Daftar lowongan perusahaan jobfair diumumkan pada tanggal 1 Juni 2020 (H-1 Job Fair) dimulai. -->
              <br>
              Pantau sosial media kami untuk melihat event terupdate :
           <ul>
           <li>Instagram : <a href="https://www.instagram.com/udinuscareercenter/">@udinuscareercenter (Klik)</a></li>
           <li>Twitter : <a href="https://twitter.com/dinus_career">@dinus_career (Klik)</a></li>
           <li>Facebook : <a href="https://www.facebook.com/udinuscc">Udinus Career Center (Klik)</a></li>
             </ul>
             <!-- <hr style="border-top: 1px dashed gray">
            *Bagi peserta virtual jobfair batch lalu, dimohon mendaftar kembali  -->
      </div>
   


        <div class="register span7">
        <form name="form" method="post" action="<?php echo base_url('daftar/submit'); ?>" onSubmit="return validasi(this)" role="form" enctype="multipart/form-data">
        <input type="hidden" value="<?=$id?>" name="idjf">
        <input type="hidden" value="<?=$jfke->id?>" name="jf_id">
            <h2>Formulir <span class="red">
            <strong>
            <?=$jfke->tipe=='online'? 'Virtual' : ''?> 
            Jobfair
            <?=$jfke->ke?> 
            UDINUS 
            </strong></span></h2>
             <!--<label for="id">Nomor Tiket</label> 
             <input type="text" id="id" name="id" value="<?php echo $id; ?>" disabled> -->
            <h3>No Tiket: <strong name="id"><?php echo $id; ?></strong></h3>
            <span class="red"><h3>GOLONGAN TIKET</h3></span>
            <div class="form-group">
            <label>Golongan</label></dt>
              <div class="form-group">
                <select name="combo1" onChange="change(this);">
                  <option value="pilih">--Pilih--</option>
                  <option value="UDINUS">UDINUS (Jika Alumni/Mahasiswa UDINUS)</option>
                  <option value="UMUM">UMUM</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <!-- <label>Tiket</label> -->
              <div class="form-group">
                <select id="sel" name="combo2" style="visibility:hidden;width:98%;" readonly>
                </select>
              </div>
            </div>

            <span class="red"><h3>DATA AKUN (LOGIN)</h3></span>  
            <div class="form-group">   
              <label for="email">Email</label> <span id="pesan_email"></span>
              <div class="form-group">
                <input type="text" id="email" name="email" placeholder="Contoh: galang@gmail.com (GMAIL Recommended)">
              </div>
            </div>
            <div class="form-group">   
              <label for="email">Password</label> <span id="pesan_email"></span>
              <div class="form-group">
                <input type="password" id="pass" name="pass" placeholder="Masukkan password yang mudah diingat">
              </div>
              <input type="checkbox" onclick="showPass()" id="eye"> Lihat Password
            </div>

            <span class="red"><h3>DATA PRIBADI</h3></span>   
            <div class="form-group">        
              <label for="nama">Nama Lengkap</label>
              <div class="form-group">
                <input type="text" id="nama" name="nama" placeholder="Contoh: Galang Rambu Anarqi">
              </div>
            </div>
            
            <div class="form-group">   
              <label for="hp">Nomor Handphone</label>
              <div class="form-group">
                <input type="text" id="hp" name="hp" placeholder="Contoh: 0856407*****">
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
                <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" style="text-transform:uppercase">
              </div>
            </div>
            <div class="form-group" id="formlulusan">
              <label for="lulusan">Tempat Pendidikan Terakhir</label>
                <div class="form-group">
                  <select class="form-control select2" name="lulusan" id="lulusan" required>
                    <option value="0">- Pilih Salah Satu Universitas / SMU -</option>
                    <?php 
                      foreach ($daftar_univ as $univ) {?>
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
                  <label>Ex IPK : Jika dari <strong>SMA / SMK</strong> masukkan <strong>Rata-rata Nilai Ujian Nasional</strong>
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

                  foreach($spesialisasi as $row){
                ?>
                  <input class="single-checkbox spek" type="checkbox" id="sp" name="sp[]" value="<?= $row['id']; ?>"> 
                  &nbsp;&nbsp;<?= $row['nama']; ?><br />
                <?php
                  }
                ?>
              </div>
            </div>
            <div class="form-group">            
            <label for="spesialisasi"> Pilih range gaji yang diinginkan</label>
              <div class="form-group">
                <select name="gaji" required>
                <option value="">Pilih</option>
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
                <select name="frekuensi" required>
                <option value="">Pilih</option>
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
            <button class="btn btn-large btn-danger" id="btndaftar" type="submit">Daftar</button>
                  <div class="form-group">
              <!-- <font size="2" color="red" width="10"> *Bila tiket tidak masuk inbox/spam pada email anda silahkan login dan unduh tiket anda di <a href="https://cc.dinus.ac.id/peserta_JF/">Website Peserta Job Fair</a></font>     -->
            </div>
          </form>
          </div>
      </div>

      <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>

    </div>


    <div class="open-button2"><center>Sudah Daftar? <a class="btn btn-info" href="https://cc.dinus.ac.id/peserta_JF">Login</a></center></div>

