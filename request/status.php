<?php
	$d = ['status' => 0];
	
	if(isset($_GET['id']) && isset($_GET['id_kandidat'])) {
		include '../sys/ORM.php';
		$obj = new ORM;

		$id = $_GET['id'];
		$id_kandidat = $_GET['id_kandidat'];

		$data = $obj->Select('id_peserta', "pemilihan WHERE id_peserta = '$id'");

		if(count($data) > 0) {
			$data = $obj->Select('id_peserta', "pemilihan WHERE id_peserta = '$id' AND id_kandidat = '$id_kandidat'");

			if(count($data) > 0)
				$d['status'] = 1;
			else
				$d['status'] = 2;			
		}
	}

	echo json_encode($d);