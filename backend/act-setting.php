<?php

$start = $_POST['start'];
$finish = $_POST['finish'];

$sStart = strtotime($start);
$sFinish = strtotime($finish);

if($sStart > $sFinish) {
	header("location:setting.php?error=value&start=$start&finish=$finish");
}

include "../sys/ORM.php";
$obj = new ORM;

$obj->Update(['value' => $start], "WHERE name = 'start'", 'setting');
$obj->Update(['value' => $finish], "WHERE name = 'finish'", 'setting');

header("location:setting.php");