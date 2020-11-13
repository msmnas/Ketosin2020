<?php
session_start();
	if(empty($_POST['user']) || empty($_POST['pass']))
	{
		// header("location:http://pilketos2018.smkn1bws.sch.id");
		header("location:index.php?error=belumdiisi");

	}
	else
	{
		include 'sys/ORM.php';
		$obj = new ORM;
		$data = $obj->Select('*', "admin where user = '$_POST[user]' and pass = md5('$_POST[pass]')");
		if(count($data) > 0) {
			$_SESSION['user'] = $_POST['user'];

			header("location:backend");
		} else {
			// header("location:http://pilketos2018.smkn1bws.sch.id");
		header("location:index.php?error=salah&user=$_POST[user]");
		}
	}
?>