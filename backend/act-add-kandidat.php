<?php 
	include "../config.php";
	include "../sys/ORM.php";
	$obj = new ORM;

	$cek = $obj->Select("*", "kandidat where nama = '$_POST[nama]' and kelas = '$_POST[kelas]' and id_jurusan = '$_POST[jurusan]'");

	if(count($cek) > 0)
	{
			header("location:add-kandidat.php?error=terdaftar&nama=$_POST[nama]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&slogan=$_POST[slogan]&visi=$_POST[visi]&visi=$_POST[misi]&kata=$_POST[kata]");
	}
	else
	{
		$pathinfo = pathinfo($_FILES['foto']['name']);

		if(!in_array($pathinfo['extension'], $type))
		{
			header("location:add-kandidat.php?error=extension&nama=$_POST[nama]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&slogan=$_POST[slogan]&visi=$_POST[visi]&visi=$_POST[misi]&kata=$_POST[kata]");
		}
		else
		{
			$source_path = $_FILES['foto']['tmp_name'];

			$target_path = "../assets/kandidat/".$_FILES['foto']['name'];
			
			if(!move_uploaded_file($source_path, $target_path))
			{
			header("location:add-kandidat.php?error=size&nama=$_POST[nama]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&slogan=$_POST[slogan]&visi=$_POST[visi]&visi=$_POST[misi]&kata=$_POST[kata]");
			}
			else
			{
				$obj->Insert(['nama' => $_POST['nama'], 'kelas' => $_POST['kelas'], 'slogan' => $_POST['slogan'], 'visi' => $_POST['visi'], 'misi' => $_POST['misi'], 'kata' => $_POST['kata'], 'id_jurusan' => $_POST['jurusan'], 'foto' => $_FILES['foto']['name']], 'kandidat');

				echo "<script>alert('Berhasil');window.location='kandidat.php'</script>";
			}
		}
	}
?>