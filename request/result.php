<?php
	include '../sys/ORM.php';
	$obj = new ORM;

	$r = ['data' => []];

	//Total Peserta
	$d1 = $obj->Select('COUNT(*) total_peserta', 'peserta')[0];
	$r['total'] = $d1['total_peserta'];

	//Total Voters
	$d2 = $obj->Select('COUNT(*) total_memilih', 'pemilihan')[0];
	$r['percent'] = round($d2['total_memilih'] * 100 / $d1['total_peserta'], 2);

	//Result Voting
	$d2 = $obj->Select("k.nama, COUNT(*) total, ROUND(COUNT(*) * 100 / $d2[total_memilih], 2) persen", 'kandidat k JOIN pemilihan p ON k.id = p.id_kandidat GROUP BY k.id');

	foreach($d2 as $d) {
		$r['data'][] = $d;
	}
	
	echo json_encode($r);