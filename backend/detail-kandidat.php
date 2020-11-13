<?php
	include "sidebar.php";
	include "../sys/ORM.php";
  $obj = new ORM;
?>
      <section id="main-content">
          <section class="wrapper">
			   <div class="row">
                  <div class="col-md-12 my-container">
                  	<h4>Ketosin 2019 / Kandidat Ketua Osis / Detail</h4>
                  	<hr class="hr">
                  	<a href="add-kandidat.php" class="btn btn-success"><i class="fa fa-plus"></i> Add Kandidat</a>
                  	<br><br>
						<?php
								$data = $obj->Select("k.nama, foto, kelas, j.nama jurusan, slogan, visi, misi, kata, biodata", "kandidat k JOIN jurusan j ON k.id_jurusan = j.id WHERE k.id = '$_GET[id]'");

								if(count($data) < 1)
									exit();

								$data = $data[0];
?>
								<div class="row">
									<div class="col-md-7">
										<div class="box">
											<img src="../assets/kandidat/<?php echo $data['foto']; ?>" class="img-responsive" style="max-height : 350px">
											<br>

											<div class="table-responsive">
												<table class="table">
													<tr>
														<td><b>Nama</b></td>
														<td>:</td>
														<td><?php echo $data['nama']; ?></td>
													</tr>
													<tr>
														<td><b>Kelas</b></td>
														<td>:</td>
														<td><?php echo $data['kelas']." ".$data['jurusan']; ?></td>
													</tr><tr>
														<td><b>Slogan</b></td>
														<td>:</td>
														<td><?php echo $data['slogan']; ?></td>
													</tr><tr>
														<td><b>Visi</b></td>
														<td>:</td>
														<td><?php echo $data['visi']; ?></td>
													</tr>													<tr>
														<td><b>Misi</b></td>
														<td>:</td>
														<td><?php echo $data['misi']; ?></td>
													</tr>						

												</table>
											</div>

										</div>
									</div>

								<div class="col-md-5">
								<?php
									$others = $obj->Select('k.id, k.nama, kelas, j.nama jurusan, foto', "kandidat k JOIN jurusan j ON j.id = k.id_jurusan");

										foreach($others as $other){
								?>
								<a href="detail-kandidat.php?id=<?php echo $other['id']; ?>">
									<div class="box">
									<div class="row">
										<div class="col-md-3">
											<img src="../assets/kandidat/<?php echo $other['foto'] ?>" class="img-circle" style="width : 60px;height : 60px;margin:auto">
										</div>
										<div class="col-md-9">
										<?php echo $other['nama']; ?>
											<hr style="margin:0">
											<?php echo $other['kelas']." ".$other['jurusan']; ?>
										</div>
									</div>
									</div>
									</a>
									<br>
									<?php } ?>
								</div>
								</div>
               </div>
        		</div>
        </section>
      </section>