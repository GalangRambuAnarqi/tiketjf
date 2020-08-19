
jQuery(document).ready(function() {

    /*
        Background slideshow
    */
    $.backstretch([
      "assets/registrasi/img/backgrounds/1.jpg"
    , "assets/registrasi/img/backgrounds/2.jpg"
    , "assets/registrasi/img/backgrounds/3.jpg"
    ], {duration: 3000, fade: 1000});

    /*
        Tooltips
    */
    $('.links a.home').tooltip();
    $('.links a.blog').tooltip();

    /*
        Form validation
    */
    $('.register form').submit(function(){
        $(this).find("label[for='nama']").html('Nama');
		$(this).find("label[for='email']").html('Email');
		$(this).find("label[for='hp']").html('No HP');
		$(this).find("label[for='alamat']").html('Alamat');
		$(this).find("label[for='nim']").html('NIS/NIM');
		$(this).find("label[for='lulusan']").html('Lulusan');
		$(this).find("label[for='jurusan']").html('Jurusan');
		$(this).find("label[for='kode']").html('Kode');
		
        ////
        var nama = $(this).find('input#nama').val();
		var email = $(this).find('input#email').val();
		var hp = $(this).find('input#hp').val();
		var alamat = $(this).find('input#alamat').val();
		var nim = $(this).find('input#nim').val();
		var lulusan = $(this).find('input#lulusan').val();
		var jurusan = $(this).find('input#jurusan').val();
		var kode = $(this).find('input#kode').val();
	

        if(nama == '') {
            $(this).find("label[for='nama']").append("<span style='display:none' class='red'> - Silakan masukkan nama lengkap Anda.</span>");
            $(this).find("label[for='nama'] span").fadeIn('medium');
            return false;
        }
		
		 if(email == '') {
            $(this).find("label[for='email']").append("<span style='display:none' class='red'> - Silakan masukkan email Anda.</span>");
            $(this).find("label[for='email'] span").fadeIn('medium');
            return false;
        }
		
		if(hp == '') {
            $(this).find("label[for='hp']").append("<span style='display:none' class='red'> - Silakan masukkan no HP Anda.</span>");
            $(this).find("label[for='hp'] span").fadeIn('medium');
            return false;
        }
		
		   if(alamat == '') {
            $(this).find("label[for='alamat']").append("<span style='display:none' class='red'> - Silakan masukkan alamat Anda.</span>");
            $(this).find("label[for='alamat'] span").fadeIn('medium');
            return false;
        }
		
		
		        if(nim == '') {
            $(this).find("label[for='nim']").append("<span style='display:none' class='red'> - Silakan masukkan NIM/NIS Anda.</span>");
            $(this).find("label[for='nim'] span").fadeIn('medium');
            return false;
        }
		
		
		        if(lulusan == '') {
            $(this).find("label[for='lulusan']").append("<span style='display:none' class='red'> - Silakan masukkan tempat pendidikan terakhir Anda.</span>");
            $(this).find("label[for='lulusan'] span").fadeIn('medium');
            return false;
        }
		
		
		        if(jurusan == '') {
            $(this).find("label[for='jurusan']").append("<span style='display:none' class='red'> - Silakan masukkan Jurusan/Progdi Anda.</span>");
            $(this).find("label[for='jurusan'] span").fadeIn('medium');
            return false;
        }
		
		
		 if(kode == '') {
            $(this).find("label[for='kode']").append("<span style='display:none' class='red'> - Silakan isi kode verifikasi.</span>");
            $(this).find("label[for='kode'] span").fadeIn('medium');
            return false;
        }

    });


});


