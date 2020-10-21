<script language="javascript">
    var arr = new Array();
    arr['pilih'] = new Array("-Pilih-");
    arr['UDINUS'] = new Array("Gratis - Tanpa dipungut biaya apapun");
    arr['UMUM'] = new Array("Gratis - Tanpa dipungut biaya apapun");

    function change(combo1){
      document.getElementById("sel").style.visibility="visible";
      document.getElementById("sel").disabled=true;
      var comboValue = combo1.value;
      document.forms["form"].elements["combo2"].options.length=0;

      for (var i=0;i<arr[comboValue].length;i++){
        var option = document.createElement("option");
        option.setAttribute('value',i+1);
        option.innerHTML = arr[comboValue][i];
        document.forms["form"].elements["combo2"].appendChild(option);
      }
      if(comboValue == 'UDINUS'){
        document.getElementById('nim').value = "";
        document.getElementById('nim').disabled = false;
        document.getElementById("lulusan").options.selectedIndex = 1;
        document.getElementById("formlulusan").style.display = "none";
      }else{
        $("#lulusan option[value='1']").remove();
         document.getElementById('nim').value = "-";
        document.getElementById('nim').disabled = true;
        document.getElementById("formlulusan").style.display = "block";
      }
    }
    </script>

    <script language="javascript">
    function validasi(form){
      
      if (form.combo1.value == "pilih"){
          alert('Maaf, Anda Belum Memilih Golongan Tiket.');
          form.combo1.focus();
          return (false);
      }

      if (form.combo2.value == ""){
          alert('Maaf, Anda Belum Memilih Tipe Tiket.');
          return (false);
      }

      if (form.nama.value == ""){
          alert('Maaf, Anda Belum Mengisi Nama.');
          form.nama.focus();
          return (false);
      }

      if (form.email.value == ""){
          alert('Maaf, Anda Belum Mengisi Email.');
          form.email.focus();
          return (false);
      }

      if (form.pass.value == ""){
          alert('Maaf, Anda Belum Mengisi Password.');
          form.email.focus();
          return (false);
      }
      
      pola_email=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      if (!pola_email.test(form.email.value)){
        alert ('Penulisan Email Tidak Valid');
        form.email.focus();
        return false;
      }  

      if (form.hp.value == ""){
          alert('Maaf, Anda Belum Mengisi No Hp.');
          form.hp.focus();
          return (false);
      }
      
      if (form.alamat.value == ""){
          alert('Maaf, Anda Belum Mengisi Alamat.');
          form.alamat.focus();
          return (false);
      }

      if (form.nim.value == ""){
          alert('Maaf, Anda Belum Mengisi NIM.');
          form.nim.focus();
          return (false);
      }

      if (form.lulusan.value == "" || form.lulusan.value == 0){
          alert('Maaf, Anda Belum Memilih Tempat Pendidikan Terakhir.');
          form.lulusan.focus();
          return (false);
      }

      // if (form.lulusan.value == ""){
      //     alert('Maaf, Anda Belum Memilih Tempat Pendidikan Terakhir.');
      //     form.lulusan.focus();
      //     return (false);
      // }

      if (form.ipk.value == ""){
          alert('Maaf, Anda Belum Mengisi Nilai.');
          form.ipk.focus();
          return (false);
      }

      if (form.jenjang.value == ""){
          alert('Maaf, Anda Belum Memilih Jenjang Pendidikan.');
          return (false);
      }

      // if (form.sp.value == ""){
      //     alert('Maaf, spesialisasi. harap diisi');
      //     return false;
      // }
      // $cbx_group = $("input:checkbox[name='sp[]']");
      // $cbx_group = $("input:checkbox[id^='option-']"); // name is not always helpful ;)

      // if($cbx_group.is(":checked")){
      //   $cbx_group.prop('required', false);
      //   return (true);
      // }else{
      //   $cbx_group.prop('required', true);
      //   return (false);
      // }

      if (!$('.spek').is(':checked')) {
             alert('Maaf, Anda Belum Memilih Spek.');
          return (false);
        }

      if (form.jurusan.value == ""){
          alert('Maaf, Anda Belum Mengisi jurusan.');
          form.jurusan.focus();
          return (false);
      }
      return (true);
    }
    </script>
<script>  
   $(document).ready(function(){  
        $('#email').change(function(){  
            $('#pesan_email').html('<img src="<?php echo base_url() ?>assets/registrasi/img/loading.gif" width="20" height="20"> checking ...');
             var email = $('#email').val();  
             if(email != '')  
             {  
                  $.ajax({  
                       url:"<?php echo base_url(); ?>daftar/cek_email",  
                       type:"POST",  
                       data:"email=" + email,  
                       success:function(data){
                        if(data == "Terdaftar"){
                            $('#pesan_email').html('<img src="assets/registrasi/img/cross.png"> Maaf, Email sudah digunakan.');
                            $("#email").val('');
                        }else{
                          $('#pesan_email').html(data);
                        } 
                       }  
                  });  
             }  
        });  
   });  
 </script>  

<script>  
   $(document).ready(function(){  
        $('#nim').change(function(){  
            $('#prodi_nim').html('<img src="<?php echo base_url() ?>assets/registrasi/img/loading.gif" width="20" height="20"> checking ...');
             var nim = $('#nim').val();  
             if(nim != '')  
             {  
                  $.ajax({  
                       url:"<?php echo base_url(); ?>daftar/cek_nim",  
                       type:"POST",  
                       data:"nim=" + nim,  
                       success:function(data){
                        if(data == "ada"){
                            $('#prodi_nim').html('<img src="assets/registrasi/img/tick.png"> NIM anda valid.');
                        }else{
                          $('#prodi_nim').html(data);
                          $("#nim").val('');
                        } 
                       }  
                  });  
             }  
        });  
   });  
 </script>  

 
 <script>
    $(document).ready(function() {
      $(".select2").select2();
    });
</script>
  <script>
    var limit = 3;
    $(document).ready(function(){
      $('.pricing-levels-3  .single-checkbox').on('change', function(evt) {
        if($(this).siblings(':checked').length >= limit) {
          this.checked = false;
        }
      });
    });

  //   $(document).ready(function () {
  //   $('#btndaftar').click(function() {
  //     checked = $("input[type=checkbox]:checked").length;

  //     if(!checked) {
  //       alert("You must check at least one checkbox.");
  //       return false;
  //     }

  //   });
  // });

  </script>


<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>


<script>
$(document).ready(function()
{ 
       $(document).bind("contextmenu",function(e){
              return false;
       }); 
})
</script>

<script>
$(document).ready( function () {
    $('#dataTables').DataTable({
    "lengthChange": false,
    "bInfo":false
  });
});
</script>

<script language="javascript">
function showPass() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>