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
      
        <div class="register span6">
          <form name="form" method="post" action="<?php echo base_url('daftar/submit'); ?>" onSubmit="return validasi(this)" role="form" enctype="multipart/form-data">
            <h2>PENDAFTARAN <span class="red"><strong>DITUTUP</strong></span></h2>
          
          </form>
        </div>
      </div>
    </div>


<button class="open-button" onclick="openForm()"><b>Lapor Masalah</button>

<div class="chat-popup" id="myForm">
  <div class="form-container">
   <center> 
    <h4>085640726824 <br>(Whatsapp)</h4>
    <!-- <h4>Untuk Pendaftaran&Tiket bisa<br>Langsung ke UDINUS</h4> -->
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