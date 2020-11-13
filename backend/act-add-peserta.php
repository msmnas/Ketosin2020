<?php
	include '../assets/phpqrcode/phpqrcode.php';
	include "../sys/ORM.php";
	$obj = new ORM;

	$cek_field = false;
	if($_POST['tipe'] == 'Guru'){
		if(empty($_POST['nama']) || empty($_POST['tipe']) || empty($_POST['qr_code'])){
			header("location:add-peserta.php?error=belumdiisi&nama=$_POST[nama]&tipe=$_POST[tipe]&qr_code=$_POST[qr_code]");
		}else{
				$cek_kode = $obj->Select("qr_code", "peserta where qr_code = '$_POST[qr_code]'");
				$status = false;
			}
	}elseif ($_POST['tipe'] == 'Siswa') {
		if(empty($_POST['nama']) || empty($_POST['tipe']) || empty($_POST['kelas']) || empty($_POST['jurusan']) || empty($_POST['qr_code'])){
			header("location:add-peserta.php?error=belumdiisi&nama=$_POST[nama]&tipe=$_POST[tipe]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&qr_code=$_POST[qr_code]");
		}else{
			$cek_kode = $obj->Select("qr_code", "peserta where qr_code = '$_POST[qr_code]'");
			$status = false;
		}
	}else{
		header("location:add-peserta.php?error=belumdiisi&nama=$_POST[nama]&tipe=$_POST[tipe]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&qr_code=$_POST[qr_code]");
	}

	
		if(count($cek_kode) > 0)
	{
		header("location:add-peserta.php?error=qr_code&nama=$_POST[nama]&tipe=$_POST[tipe]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&qr_code=$_POST[qr_code]");
	}
	else
	{
		$arr = ['nama' => $_POST['nama'], 'tipe' => $_POST['tipe'], 'qr_code' => $_POST['qr_code']];
		if($_POST['tipe']=='Guru')
		{
			//$sql = "insert into peserta (nama,tipe,qr_code) values('".$_POST['nama']."', '".$_POST['tipe']."', '".$_POST['qr_code']."')";
			$obj->Insert($arr, 'peserta');
			$status = true;

			echo "<script>alert('Berhasil');window.location='peserta.php'</script>";

		}
		else if($_POST['tipe']=='Siswa')
		{
		
				$query_cek = $obj->Select("*", "peserta where nama = '".$_POST['nama']."' and kelas = '".$_POST['kelas']."' and id_jurusan = '".$_POST['jurusan']."'");

				if(count($query_cek) < 1)
				{
					//$sql = "insert into peserta (nama,tipe,qr_code,kelas,id_jurusan) values('".$_POST['nama']."', '".$_POST['tipe']."', '".$_POST['qr_code']."', '".$_POST['kelas']."', '".explode('-', $_POST['jurusan'])[0]."')";

					$arr['kelas'] = $_POST['kelas'];
					$arr['id_jurusan'] = explode('-', $_POST['jurusan'])[0];

					$obj->Insert($arr, 'peserta');
					$status = true;

					echo "<script>alert('Berhasil');window.location='peserta.php'</script>";
				}
				else
				{
					header("location:add-peserta.php?error=terdaftar&nama=$_POST[nama]&tipe=$_POST[tipe]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&qr_code=$_POST[qr_code]");
				}

		}

		if($status) {
			//Add qr code
			$nm = str_replace(' ', '-', $_POST['nama']) . '.png';
			$extended = $_POST['tipe'] == 'Siswa' ? $_POST['kelas'] . '-' . str_replace(' ', '-', explode('-', $_POST['jurusan'])[1]) . '/' : '';
					
			QRcode::png($_POST['qr_code'], "../assets/QR/$_POST[tipe]/$extended" . $nm, QR_ECLEVEL_L, 4);
		}
	}
?>