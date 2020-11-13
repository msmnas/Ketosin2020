<?php
	include "../sys/ORM.php";
  $obj = new ORM;

	$d2 = $obj->Select("COUNT(*) total_memilih", "pemilihan")[0];

	$q = $obj->Select("k.nama, ROUND(COUNT(*) * 100 / $d2[total_memilih], 2) y", "kandidat k JOIN pemilihan p ON k.id = p.id_kandidat GROUP BY k.id");

	foreach($q as $d) {
		$r[] = ['name' => $d['nama'], 'y' => round($d['y'], 2)];
	}

	echo json_encode($r);