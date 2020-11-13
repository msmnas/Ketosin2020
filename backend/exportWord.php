<?php 
include "../config.php";

include "../sys/ORM.php";
  $obj = new ORM;
  $j = $obj->select("nama", "jurusan where id=$_GET[jurusan]")[0];
  // print_r($j);
//  header("Content-type: application/vnd.ms-word;charset=UTF-8");
// header("Content-Disposition: attachment;Filename=$_GET[kelas]_$j[nama].doc"); 
  $type = $_GET['tipe'];
  $where = " tipe LIKE '%$_GET[tipe]%'";

			if($_GET['kelas'] != '')
				$where .= "AND kelas = '$_GET[kelas]'";

			if($_GET['jurusan'] != '')
				$where .= "AND id_jurusan = '$_GET[jurusan]'";

			if($_GET['status'] != '') {
				if($_GET['status'] == 'Sudah')
					$where .= "AND p2.id is not null";
				else if($_GET['status'] == 'Belum')
					$where .= "AND p2.id is null";
			}

			//$sql = mysql_query("select p.id, p.nama, j.nama jurusan, qr_code, kelas, tipe, case when p2.id is null then 'Belum Memilih' else 'Sudah Memilih' end status from peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc LIMIT $idx, 30");
			if($type == 'Guru'){
				$sql = $obj->Select("p.id, p.nama,  qr_code, tipe, case when p2.id is null then 'Belum Memilih' else 'Sudah Memilih' end status", "peserta p left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc ");
			}else{
				$sql = $obj->Select("p.id, p.nama, j.nama jurusan, qr_code, kelas, tipe, case when p2.id is null then 'Belum Memilih' else 'Sudah Memilih' end status", "peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc ");
			}

			//$sql2 = mysql_query("select count(*) total from peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc");

			$total = $obj->Select("count(*) total", "peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc")[0]['total'];
 ?>
<!--  <table>
 	<tr>
 		<th>name</th>
 	</tr>
  -->
<?php
	$no = 1;
	foreach($sql as $data)
	{

		$no++;
?>
<!-- <tr>
	<td><?= $data['name'] ?></td>
</tr> -->
<div class="col-md-4 text-center">
	<p><?= $data['nama'] ?></p>
	<img class="img-qr" src="<?= BASEURL."assets/QR/$type/$data[kelas]-".str_replace(" ", "-", $data[jurusan])."/".str_replace(" ", "-", $data['nama']).".png" ?>">
	<p><?= $data['qr_code'] ?></p>
</div>
<?php } ?>
<!-- </table> -->
<style type="text/css">
.img-qr{
	height: 300px;
	width: 300px;
}
.text-center{
	text-align: center;
}
	[class*='col-']{
	float: left;
	padding: 12px;
}
*{
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-o-box-sizing: border-box;
}
@media(min-width: 768px){
	.col-md-1{
		width: 8.333%;
	}
	.col-md-2{
		width: 16.666%;
	}
	.col-md-3{
		width: 25%;
	}
	.col-md-4{
		width: 33.333%;
	}
	.col-md-5{
		width: 41.666%;
	}
	.col-md-6{
		width: 50%;
	}
	.col-md-7{
		width: 58.333%;
	}
	.col-md-8{
		width: 66.666%;
	}
	.col-md-9{
		width: 75%;
	}
	.col-md-10{
		width: 83.333%;
	}
	.col-md-11{
		width: 91.333%;
	}
	.col-md-12{
		width: 100%;
	}
}
</style>