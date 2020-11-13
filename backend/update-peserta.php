<?php
	include "../sys/ORM.php";
	$obj = new ORM;
	$id= $_GET['id'];
	$cek_field = false;
	if(empty($_POST['nama']) || empty($_POST['tipe']) || empty($_POST['qr_code'])){
		header("location:edit-peserta.php?error=belumdiisi&nama=$_POST[nama]&tipe=$_POST[tipe]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&qr_code=$_POST[qr_code]&id=$id");
	}else{
		$cek_kode = $obj->Select("qr_code", "peserta where qr_code = '$_POST[qr_code]'");
		$status = false;
	}

	$arr = ['nama' => $_POST['nama'], 'tipe' => $_POST['tipe']];
	if($_POST['tipe']=='Guru')
	{
		$obj->Update($arr, "where id = '$id'", "peserta");
	}
	else if($_POST['tipe']=='Siswa')
	{
		$arr['kelas'] = $_POST['kelas'];
		$arr['id_jurusan'] = $_POST['jurusan'];
		$obj->Update($arr, "where id = $id", "peserta");	
	}

	echo "<script>alert('Berhasil');window.location='peserta.php'</script>";
?>