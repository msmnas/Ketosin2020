<?php
	date_default_timezone_set('Asia/Jakarta');

	include '../sys/ORM.php';
	$obj = new ORM;

	/*** ERROR TYPE

		status => 'fail'		= Wrong qr_code
		status => 'start'		= Not starting
		status => 'finish'	=	Has been finish
		status => 'success'			= Success

	***/

	if(isset($_POST['qr_code'])) {
		$qr = $_POST['qr_code'];
		$data = $obj->Select("*", "peserta WHERE qr_code = '$qr'");

		if(count($data) > 0) {
			$now = date('Y-m-d H:i:s');
			$sNow = strtotime($now);

			$start = $obj->Select("value", "setting WHERE name = 'start'")[0]['value'];
			$finish = $obj->Select("value", "setting WHERE name = 'finish'")[0]['value'];
			$start = date_format(date_create($start), 'Y-m-d H:i:s');
			$finish = date_format(date_create($finish), 'Y-m-d H:i:s');

			$sStart = strtotime($start);
			$sFinish = strtotime($finish);

			if($sNow < $sStart)
				$data = ['status' => 'start'];
			else if($sNow > $sFinish)
				$data = ['status' => 'finish'];
			else
				$data = array_merge(['status' => 'success'], $data[0]);
		}
		else {
			$data = ['status' => 'fail'];
		}
	}
	else
		$data = ['status' => 'fail'];

	echo json_encode($data);