<?php
	/**
	KONFIGURASI KONEKSI KE DATABASE
	BY 	: ADE INDRA SAPUTRA
	NIM : 8020110115
	*/

	//$host = "127.0.0.1";
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "db_apsqrcode";
	
	$connect = @mysql_connect($host, $user, $pass) 
							or die("Tidak terkoneksi ke server ...!");
	if($connect) {
		mysql_select_db($db, $connect) 
						or die("Tidak terhubung ke database ...!");
	}

?>