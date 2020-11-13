<?php

	include "../config.php";
	include "../sys/ORM.php";
  $obj = new ORM;

	$arr = ['nama' => $_POST['nama'], 'kelas' => $_POST['kelas'], 'slogan' => $_POST['slogan'], 'visi' => $_POST['visi'], 'misi' => $_POST['misi'], 'kata' => $_POST['kata'], 'id_jurusan' => $_POST['jurusan']];

	if(empty($_FILES['foto']['name']))
	{
		$obj->Update($arr, "WHERE id = '$_GET[id]'", 'kandidat');

		echo "<script>alert('Berhasil');window.location='kandidat.php'</script>";
	}
	else
	{
		$pathinfo = pathinfo($_FILES['foto']['name']);

		if(!in_array($pathinfo['extension'], $type))
		{
			header("location:edit-kandidat.php?error=extension&nama=$_POST[nama]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&slogan=$_POST[slogan]&visi=$_POST[visi]&misi=$_POST[misi]&kata=$_POST[kata]&id_foto=$_GET[id]");
		}
		else
		{
			$source_path = $_FILES['foto']['tmp_name'];

			$target_path = "../assets/kandidat/".$_FILES['foto']['name'];
			
			if(!move_uploaded_file($source_path, $target_path))
			{
			header("location:edit-kandidat.php?error=size&nama=$_POST[nama]&kelas=$_POST[kelas]&jurusan=$_POST[jurusan]&slogan=$_POST[slogan]&visi=$_POST[visi]&misi=$_POST[misi]&kata=$_POST[kata]&id_foto=$_GET[id]");
		
			}
			else
			{
				
		$arr['foto'] = $_FILES['foto']['name'];
		$obj->Update($arr, "WHERE id = '$_GET[id]'", 'kandidat');
				echo "<script>alert('Berhasil');window.location='kandidat.php'</script>";

			}

		}
	}


?>