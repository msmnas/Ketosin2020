<style type="text/css">
	.inline{
		display: inline-block;
	}
</style>
<?php
	include "sidebar.php";
	include "../config.php";
	include "../sys/ORM.php";
  $obj = new ORM;

		$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$idx = $page * 30 - 30;

		if(isset($_GET['cari']) && isset($_GET['kelas']) && isset($_GET['jurusan']) && isset($_GET['tipe']))
		{
			$where = "p.nama like '%$_GET[cari]%' AND tipe LIKE '%$_GET[tipe]%'";

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

			$sql = $obj->Select("p.id, p.nama, j.nama jurusan, qr_code, kelas, tipe, case when p2.id is null then 'Belum Memilih' else 'Sudah Memilih' end status", "peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc LIMIT $idx, 30");

			//$sql2 = mysql_query("select count(*) total from peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc");

			$total = $obj->Select("count(*) total", "peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id where $where order by p.id desc")[0]['total'];

			$value = $_GET['cari'];
		}
		else
		{
			//$sql = mysql_query("select p.id, p.nama, j.nama jurusan, qr_code, kelas, tipe, case when p2.id is null then 'Belum Memilih' else 'Sudah Memilih' end status from peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id order by p.id desc LIMIT $idx, 30");

			$sql = $obj->Select("p.id, p.nama, j.nama jurusan, qr_code, kelas, tipe, case when p2.id is null then 'Belum Memilih' else 'Sudah Memilih' end status", "peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id order by p.id desc LIMIT $idx, 30");

			//$sql2 = mysql_query("select count(*) total from peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id order by p.id desc");

			$total = $obj->Select("count(*) total", "peserta p left join jurusan j on p.id_jurusan = j.id left join pemilihan p2 on p2.id_peserta = p.id order by p.id desc")[0]['total'];

			$value = "";
		}

?>
    <section id="main-content">
          <section class="wrapper">
			   <div class="row">
                  <div class="col-md-12 my-container">
  		              	<h4>Ketosin 2019 / Peserta</h4>
	                  	<hr class="hr">
	                  	<div class="row">
	                  	
	                  	<div class="col-md-12  search">
		                  	<form action="" method="get" class="form-inline">
		                  		<div class="form-group">
		                  			<select class="form-control" name="tipe">
		                  				<option value="">- Tipe -</option>
		                  				<option value="Guru" <?php echo isset($_GET['tipe']) && $_GET['tipe'] == 'Guru' ? 'selected' : '' ?>>Guru</option>
		                  				<option value="Siswa" <?php echo isset($_GET['tipe']) && $_GET['tipe'] == 'Siswa' ? 'selected' : '' ?>>Siswa</option>
		                  			</select>
		                  		</div>

		                  		<div class="form-group">
		                  			<select class="form-control" name="kelas">
		                  				<option value="">- Kelas -</option>
		                  				<option value="X" <?php echo isset($_GET['kelas']) && $_GET['kelas'] == 'X' ? 'selected' : '' ?>>X</option>
		                  				<option value="XI" <?php echo isset($_GET['kelas']) && $_GET['kelas'] == 'XI' ? 'selected' : '' ?>>XI</option>
		                  				<option value="XII" <?php echo isset($_GET['kelas']) && $_GET['kelas'] == 'XII' ? 'selected' : '' ?>>XII</option>
		                  			</select>
		                  		</div>

		                  		<div class="form-group">
		                  			<select class="form-control" name="jurusan">
		                  				<option value="">- Jurusan -</option>
		                  				<option value="1" <?php echo isset($_GET['jurusan']) && $_GET['jurusan'] == '1' ? 'selected' : '' ?>>Administrasi Perkantoran</option>
		                  				<option value="2" <?php echo isset($_GET['jurusan']) && $_GET['jurusan'] == '2' ? 'selected' : '' ?>>Akuntasi</option>
		                  				<option value="3" <?php echo isset($_GET['jurusan']) && $_GET['jurusan'] == '3' ? 'selected' : '' ?>>Multimedia</option>
		                  				<option value="4" <?php echo isset($_GET['jurusan']) && $_GET['jurusan'] == '4' ? 'selected' : '' ?>>Perbankan</option>
		                  				<option value="5" <?php echo isset($_GET['jurusan']) && $_GET['jurusan'] == '5' ? 'selected' : '' ?>>Rekayasa Perangkat Lunak</option>
		                  				<option value="6" <?php echo isset($_GET['jurusan']) && $_GET['jurusan'] == '6' ? 'selected' : '' ?>>Tata Niaga</option>
		                  				<option value="7" <?php echo isset($_GET['jurusan']) && $_GET['jurusan'] == '7' ? 'selected' : '' ?>>Teknik Komputer Jaringan</option>
		                  				<option value="8" <?php echo isset($_GET['jurusan']) && $_GET['jurusan'] == '8' ? 'selected' : '' ?>>TP3TV</option>
		                  			</select>
		                  		</div>

		                  		<div class="form-group">
		                  			<select class="form-control" name="status">
		                  				<option value="">- Status -</option>
		                  				<option value="Sudah" <?php echo isset($_GET['status']) && $_GET['status'] == 'Sudah' ? 'selected' : '' ?>>Sudah Memilih</option>
		                  				<option value="Belum" <?php echo isset($_GET['status']) && $_GET['status'] == 'Belum' ? 'selected' : '' ?>>Belum Memilih</option>
		                  			</select>
		                  		</div>

		                  		<div class="form-group">
		                  			<input type="text" name="cari" value="<?php echo $value; ?>" class="form-control" placeholder="Cari Peserta Disini..">
		                  		</div>
			                  	
			                  	<button class="btn btn-primary">Filter</button>
			                 </form>
	                  	</div>
	                  	<div class="col-md-12">
	                  	<a href="add-peserta.php" class="btn btn-success inline"><i class="fa fa-plus"></i> Add Peserta</a>
	                  	<a class="btn btn-success open_modal_siswa inline"><i class="fa fa-plus"></i> Import Peserta</a>
	                  	<?php if(isset($_GET['cari'])){ 
	                  		$type = $_GET['tipe'];
	                  		$kelas = $_GET['kelas'];
	                  		$jurusan = $_GET['jurusan'];
	                  		$status = $_GET['status'];
	                  		?>
	                  	<a class="btn btn-success  inline" href="export.php?tipe=<?= $type."&kelas=".$kelas."&jurusan=".$jurusan."&status=".$status ?>"><i class="fa fa-plus"></i> Export</a>
	                  	<a class="btn btn-success  inline" href="exportWord.php?tipe=<?= $type."&kelas=".$kelas."&jurusan=".$jurusan."&status=".$status ?>"><i class="fa fa-plus"></i> Export QR</a>
	                  	<?php } ?>
	                  	</div>
	                  	</div>
	                  	<br><br>
	                  	<div class="pull-right" style="font-size: 15px"><b><?php echo $total ?></b> Data Available</div>
	                  	<br><br>
	                  	<div class="table-responsive">
	                  		<table class="table table-bordered table-striped table-hover">
	                  			<thead>
	                  				<tr>
	                  					<td>#</td>
	                  					<td>Nama Peserta</td>
	                  					<td>Tipe</td>
	                  					<td>QR Kode</td>
	                  					<td>Status</td>
	                  					<td colspan="2">Opsi Lainnya</td>
	                  				</tr>
	                  			</thead>
	                  			<tbody>
				  					<?php
				  						$no = $page * 30 - 30;
				  						foreach($sql as $data)
				  						{
					                 
					   	   				$no++;
				  					?>
				  						<tr>
				  							<td><?php echo $no; ?></td>
				  							<td><?php echo $data['nama']; ?></td>
				  							<td><?php echo $data['tipe']; echo ($data['tipe'] == 'Siswa') ? " ($data[kelas] $data[jurusan])" : ''; ?></td>
				  							<td><?php echo $data['qr_code']; ?></td>
				  							<td><?php echo $data['status']; ?></td>
				  							<td>
				  								<div class="btn-group">
				  									<button class="btn btn-default link-edit" data-url="edit-peserta.php?id=<?php echo $data['id']; ?>">Edit</button>
				  									<button class="btn btn-warning link-hapus" data-url="hapus.php?db=peserta&id=<?php echo $data['id']; ?>">Hapus</button>
				  								</div>
				  							</td>
				  						</tr>
				  					<?php } ?>
	                  			</tbody>
	                  		</table>

	                  	<ul class="pagination" style="font-size: 15px">
											  <?php
											  	$url = "";

											  	if(isset($_GET['cari']))
											  		$url .= "?tipe=$_GET[tipe]&kelas=$_GET[kelas]&jurusan=$_GET[jurusan]&status=$_GET[status]&cari=$_GET[cari]&";
											  	else
											  		$url .= "?";

											  	$ttlPage = ceil($total / 30);

											  	for($i = 1; $i <= $ttlPage; $i++) {
											  		echo "<li><a href='$url". "page=$i'>$i</a></li>";
											  	}
											  ?>
											</ul>
	  					</div>
  				  </div>
  				</div>
  				<div id="Modalviewimportsiswa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				</div>
  				<script type="text/javascript">
			   $(document).ready(function () {
			   $(".open_modal_siswa").click(function(e) {
			      var m = $(this).attr("id");
					   $.ajax({
			    			   url: "importpeserta.php",
			    			   type: "GET",
			    			   // data : {kd_guru: m,},
			    			   success: function (ajaxData){
			      			   $("#Modalviewimportsiswa").html(ajaxData);
			      			   $("#Modalviewimportsiswa").modal('show',{backdrop: 'true'});
			      		   }
			    		   });
			        });
			      });
</script>
  			</section>
  	</section>