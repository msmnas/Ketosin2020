<?php
	include '../sys/ORM.php';
	$obj = new ORM;

	$data = $obj->Select("k.id, k.nama, CONCAT(kelas, ' ', j.nama) kelas, visi, misi, foto, slogan, kata, biodata", 'kandidat k JOIN jurusan j ON k.id_jurusan = j.id');

	echo json_encode($data);