<?php
	$d = ['status' => 0];

	if(isset($_POST['id']) && isset($_POST['id_kandidat'])) {
		include '../sys/ORM.php';
		$obj = new ORM;
		
		$id = $_POST['id'];
		$id_kandidat = $_POST['id_kandidat'];
		

		try {
			$obj->Insert(['id_peserta' => $id, 'id_kandidat' => $id_kandidat], 'pemilihan');
			$d = ['status' => 1];
		}
		catch(Exception $e) {
			$d = ['status' => 0];
		}
	}	

	echo json_encode($d);