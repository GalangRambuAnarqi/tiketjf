<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view('daftar/templates/head.php'); ?>
<body>
<div id="page" class="page">
    <?php $this->load->view('daftar/templates/title.php'); ?>
    <?php $this->load->view('daftar/page/'.$page.'.php',$content); ?>
    <?php $this->load->view('daftar/templates/footer.php'); ?>
</div>
	<?php $this->load->view('daftar/templates/script.php'); ?>
</body>
</html>
