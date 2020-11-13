<?php
	include "sidebar.php";
	include "../sys/ORM.php";
  $obj = new ORM;

  $data = $obj->Select('*', "peserta where id = '$_GET[id]'");
  if(count($data) < 1)
    exit();

  $data = $data[0];
?>
<section id="main-content">
     <section class="wrapper">
		   <div class="row">
                 <div class="col-md-12 my-container">
                  	<h4>Ketosin 2019 / Peserta / Edit</h4>
                  	
                  	<hr class="hr">
                  	
                  	<div class="row">
                 		<div class="col-md-7">
                        <?php
                              if(isset($_GET['error']))
                              {
                                    echo "<div class='alert alert-danger danger'>";
                                    if($_GET['error']=='extension')
                                    {
                                          echo "Pastikan Ekstensi Foto Sudah Benar";
                                    }
                                    else
                                    {
                                          if($_GET['error']=='size')
                                          {
                                                echo "Ukuran File Foto Terlalu Besar";
                                          }
                                          else if($_GET['error']=='belumdiisi')
                                          {
                                                echo 'Pastikan Semua Field Terisi';
                                          }
                                          else
                                          {
                                                echo "-";
                                          }
                                    }
                                    echo "</div>";
                              }
                        ?>
                 			<form action="update-peserta.php?id=<?php echo $data['id']; ?>" method="post">
                  				Nama Peserta
                  				<br>
                  				<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>	
                  				<br>
                                          Tipe Peserta
                                          <?php
                                                if($data['tipe']=='Guru')
                                                {
                                                      $guru = "selected";
                                                }
                                                else
                                                {
                                                      $guru = "";
                                                }

                                                if($data['tipe']=="Siswa")
                                                {
                                                      $siswa = "selected";
                                                }
                                                else
                                                {
                                                      $siswa = "";
                                                }
                                          ?>
                                          <select name="tipe" class="form-control tipe">
                                                <option>Pilih Tipe</option>
                                                <option value='Guru' <?php echo $guru; ?>>Guru</option>
                                                <option value='Siswa' <?php echo $siswa; ?>>Siswa</option>
                                          </select>
                  				<br>
                                          <div class="hideshow" data-tipe="<?php echo $data['tipe']; ?>">
                  				Kelas
                  				<br>
                                          <?php
                                             if($data['kelas']=='X')
                                             {
                                                   $a = "selected";
                                             }
                                             else
                                             {
                                                   $a = "";
                                             }

                                                 if($data['kelas']=='XI')
                                                            {
                                                                  $b = "selected";
                                                            }
                                                            else
                                                            {
                                                                  $b = "";
                                                            }
                                                            
                                                            if($data['kelas']=='XII')
                                                            {
                                                                  $c = "selected";
                                                            }
                                                            else
                                                            {
                                                                  $c = "";
                                                            }
                                          ?>

                  				<select class="form-control" name="kelas" required>
                  					<option>Pilih Kelas</option>
                  					<option value='X' <?php echo $a; ?>>X</option>
                  					<option value='XI' <?php echo $b; ?>>XI</option>
                  					<option value='XII' <?php echo $c; ?>>XII</option>
                  				</select>
                  				<br>
                  				Jurusan / Paket Keahlian
                  				<br>
                  				<select class="form-control" name="jurusan" required>
                  					<option>Pilih Jurusan</option>
                  					<?php
                  						$jurusans = $obj->Select('id, nama', "jurusan");
                  						foreach ($jurusans as $jurusan) {
                                                            if($data['id_jurusan']==$jurusan['id'])
                                                            {
                                                                  $selected = "selected";
                                                            }
                                                            else
                                                            {
                                                                  $selected = "";
                                                            }
                  							echo "<option value='".$jurusan['id']."' $selected>".$jurusan['nama']."</option>";
                  						}
                  					?>
                  				</select>
                                          <br>
                                          </div>
                                          QR Kode
                                          <input type="text" class="form-control" value="<?php echo $data['qr_code']; ?>" readonly>     
                                          <br>
                                          <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                          <a href="peserta.php"class="btn btn-default go-back"  type="cancel"><i class="fa fa-cancel"></i> Batal</a>
                  			</form>
                  		</div>
                              <div class="col-md-5">
                                    <img src="../assets/img/pocong.jpg">
                              </div>
                  </div>
                  </div>
		   </div>
	</section>
</section>
<script>
      $(document).ready(function(){
            var tipe = $(".hideshow").data("tipe");
                  if(tipe=='Guru')
                  {
                        $(".hideshow").hide()
                  }
                  else
                  {
                        $(".hideshow").show()
                  }
            $(document).on("change","select.tipe", function(){
                  var a = $(".tipe").val()
                  if(a=='Siswa')
                  {
                        $(".hideshow").show()
                  }
                  else
                  {
                        $(".hideshow").hide()
                  }
            })
      })
</script>