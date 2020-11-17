<?php
	include "sidebar.php";
	include "../sys/ORM.php";
  $obj = new ORM;


  $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
		$idx = $page * 30 - 30;

		if(isset($_GET['cari']) && isset($_GET['kelas']) && isset($_GET['jurusan']) && isset($_GET['tipe']))
		{
			$where = "s.nama like '%$_GET[cari]%' AND tipe LIKE '%$_GET[tipe]%'";

			if($_GET['kelas'] != '')
				$where .= "AND s.kelas = '$_GET[kelas]'";

			if($_GET['jurusan'] != '')
				$where .= "AND s.id_jurusan = '$_GET[jurusan]'";

			if($_GET['kandidat'] != '') {
				$where .= "AND k.id = '$_GET[kandidat]'";
			}

			$sql = $obj->Select("p.id, s.nama, s.tipe, s.kelas, j.nama as nama_jurusan, k.nama as nama_kandidat, waktu", "pemilihan as p join peserta as s on p.id_peserta = s.id LEFT JOIN jurusan as j on s.id_jurusan = j.id LEFT JOIN kandidat as k on p.id_kandidat = k.id where $where order by p.id desc limit $idx, 30");

			$total = $obj->Select("count(*) total", "pemilihan as p join peserta as s on p.id_peserta = s.id LEFT JOIN jurusan as j on s.id_jurusan = j.id LEFT JOIN kandidat as k on p.id_kandidat = k.id where $where")[0]['total'];

			$value = $_GET['cari'];
		}
		else
		{
			$sql = $obj->Select("p.id, s.nama, s.tipe, s.kelas, j.nama as nama_jurusan, k.nama as nama_kandidat, waktu", "pemilihan as p join peserta as s on p.id_peserta = s.id LEFT JOIN jurusan as j on s.id_jurusan = j.id LEFT JOIN kandidat as k on p.id_kandidat = k.id order by p.id desc limit $idx, 30");

			$total = $obj->Select("count(*) total", "pemilihan as p join peserta as s on p.id_peserta = s.id LEFT JOIN jurusan as j on s.id_jurusan = j.id LEFT JOIN kandidat as k on p.id_kandidat = k.id")[0]['total'];

			$value = "";
		}


?>
    <section id="main-content">
          <section class="wrapper">
			   <div class="row">
                  <div class="col-md-12 my-container">
  		              	<h4>Ketosin 2019 / Pemilihan</h4>
	                  	<hr class="hr">

	                  	<div class="row">
	                  		<div class="col-md-12">
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
			                  		<?php $k = $obj->Select('id, nama', 'kandidat ORDER BY nama ASC'); ?>
			                  			<select class="form-control" name="kandidat">
			                  				<option value="">- Kandidat -</option>
			                  				<?php
			                  					foreach($k as $c)
			                  						echo "<option value='$c[id]' " . (isset($_GET['kandidat']) && $_GET['kandidat'] == '$c[id]' ? 'selected' : '') . ">$c[nama]</option>";
			                  				?>
			                  			</select>
			                  		</div>

			                  		<div class="form-group">
			                  			<input type="text" name="cari" value="<?php echo $value; ?>" class="form-control" placeholder="Cari Disini..">
			                  		</div>
				                  	
				                  	<button class="btn btn-primary">Filter</button>
				                 </form>
		                  	</div>
	                  	</div>

	                  	<div class="pull-right" style="font-size: 15px"><b><?php echo $total ?></b> Data Available</div>
	                  	<br><br>

	                  	<div class="table-responsive">
	                  		<table class="table table-bordered table-striped table-hover">
	                  			<thead>
	                  				<tr>
	                  					<td>#</td>
	                  					<td>Nama</td>
	                  					<td>Tipe</td>
	                  					<td>Pilihan</td>
															<td>Waktu</td>
	                  					<td>Aksi</td>
	                  				</tr>
	                  			</thead>
	                  			<tbody>
	                  			<?php 



	                  				$no=$idx;
	                  				foreach($sql as $data)
	                  				{
	                  								$no++;
	                  								?>
	                  									<tr>
	                  										<td><?php echo $no; ?></td>
	                  										<td><?php echo $data['nama']; ?></td>
								  							<td><?php echo $data['tipe']; echo ($data['tipe'] == 'Siswa') ? " ($data[kelas] $data[nama_jurusan])" : ''; ?></td>
								  							<td><?php echo $data['nama_kandidat']; ?></td>
																<td><?php echo date("G:i, d m y", strtotime($data['waktu'])) ?></td>
								  							<td>
								  								<div class="btn-group">
								  									<button class="btn btn-warning link-hapus" data-url="hapus.php?db=pemilihan&id=<?php echo $data['id']; ?>">Hapus</button>
								  								</div>
								  							</td>
	                  									</tr>
	                  								<?php
	                  				}

	                  			?>
	                  			</tbody>
	                  		</table>
	                  	</div>
	                  	<ul class="pagination" style="font-size: 15px">
											  <?php
											  	$url = "";

											  	if(isset($_GET['cari']))
											  		$url .= "?tipe=$_GET[tipe]&kelas=$_GET[kelas]&jurusan=$_GET[jurusan]&kandidat=$_GET[kandidat]&cari=$_GET[cari]&";
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
	       </section>
	</section>             