<?php
	
	include "../config.php";
	include "../sys/ORM.php";
  $obj = new ORM;

	$obj->Delete("where id = '$_GET[id]'", $_GET['db']);

	echo "<script>alert('Berhasil');window.location='".$_GET['db'].".php'</script>";
?>