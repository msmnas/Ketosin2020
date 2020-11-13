<?php 

include "../config.php";
	include "../sys/ORM.php";
	header('Content-Type:application/vnd.ms-excel');
header('Content-Disposition:attachment;filename=export_data_QR.xls');
  $obj = new ORM;
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

			$sql = $obj->Select("p.id, p.nama, j.nama jurusan, qr_code, kelas, tipe, case when p2.id is null then 'Belum Memilih' else 'Sudah Memilih' end status", "peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc ");

			//$sql2 = mysql_query("select count(*) total from peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc");

			$total = $obj->Select("count(*) total", "peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc")[0]['total'];
 ?>
 <table class="table table-bordered table-striped table-hover" border="1">
	                  			<thead>
	                  				<tr>
	                  					<td>#</td>
	                  					<td>Nama Peserta</td>
	                  					<td>Tipe</td>
	                  					<td>QR Kode</td>
	                  				</tr>
	                  			</thead>
	                  			<tbody>
				  					<?php
				  						$no = 1;
				  						foreach($sql as $data)
				  						{
					                 
					   	   				$no++;
				  					?>
				  						<tr>
				  							<td><?php echo $no; ?></td>
				  							<td><?php echo $data['nama']; ?></td>
				  							<td><?php echo $data['tipe']; echo ($data['tipe'] == 'Siswa') ? " ($data[kelas] $data[jurusan])" : ''; ?></td>
				  							<td><?php echo $data['qr_code']; ?></td>
				  							
				  						</tr>
				  					<?php } ?>
	                  			</tbody>
	                  		</table>