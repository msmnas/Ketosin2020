<?php
	include "sidebar.php";
	include "../sys/ORM.php";
      $obj = new ORM;
?>
<section id="main-content">
     <section class="wrapper">
		   <div class="row">
                 <div class="col-md-12 my-container">
                  	<h4>Ketosin 2018 / Kandidat Ketua Osis / Add</h4>
                  	
                  	<hr class="hr">
                  	
                  	<div class="row">
                 		<div class="col-md-8 col-md-offset-2">
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
                                          else
                                          {
                                                if($_GET['error']=='terdaftar')
                                                {
                                                      echo "Kandidat Ini Telah Terdaftar Sebelumnya";
                                                }
                                                else
                                                {
                                                      echo "-";
                                                }
                                          }
                                    }
                                    echo "</div>";
                              }
                        ?>
                 			<form action="act-add-kandidat.php" method="post" enctype="multipart/form-data">
                  				Nama Kandidat
                  				<br>
                  				<input type="text" name="nama" value="<?php if(isset($_GET['nama'])) echo $_GET['nama']; else echo ""; ?>" class="form-control" required>	
                  				<br>
								Foto
                  				<br>
                  				<input type="file" name="foto" required>	
                  				<br>
                  				Kelas
                  				<br>
                                          <?php
                                                if(isset($_GET['kelas']))
                                                {
                                                      if($_GET['kelas']=='X')
                                                      {
                                                            $a = "selected";
                                                      }
                                                      else
                                                      {
                                                            $a = "";
                                                      }

                                                      if($_GET['kelas']=='XI')
                                                      {
                                                            $b = "selected";
                                                      }
                                                      else
                                                      {
                                                            $b = "";
                                                      }
                                                      
                                                      if($_GET['kelas']=='XII')
                                                      {
                                                            $c = "selected";
                                                      }
                                                      else
                                                      {
                                                            $c = "";
                                                      }
                                                      
                                                } 
                                                else
                                                {
                                                      $a = "";
                                                      $b = "";
                                                      $c = "";
                                                }
                                          ?>
                  				<select class="form-control" name="kelas" required>
                  					<option>Pilih Kelas</option>
                  					<option <?php echo $a; ?>>X</option>
                  					<option <?php echo $b; ?>>XI</option>
                  					<option <?php echo $c; ?>>XII</option>
                  				</select>
                  				<br>
                  				Jurusan / Paket Keahlian
                  				<br>
                  				<select class="form-control" name="jurusan" required>
                  					<option>Pilih Jurusan</option>
                  					<?php
                                                      $datas = $obj->Select('id, nama', "jurusan");
                  						foreach ($datas as $data) {
                                                            if(isset($_GET['jurusan']))
                                                            {
                                                                  if($data['id']==$_GET['jurusan'])
                                                                  {
                                                                        $selected = "selected";
                                                                  }
                                                                  else
                                                                  {
                                                                        $selected = "";
                                                                  }
                                                            }
                  							echo "<option value='".$data['id']."' $selected>".$data['nama']."</option>";
                  						}
                  					?>
                  				</select>
                                          <br>
                                          Slogan
                                          <br>
                                          <input type='text' class="form-control" name="slogan" value='<?php if(isset($_GET['slogan'])) echo $_GET['slogan']; else echo ""; ?>' required></textarea>
                  				<br>
                  				Visi
                  				<br>
                  				<textarea id="editor1" class="form-control" rows="10" name="visi" required><?php if(isset($_GET['visi'])) echo $_GET['visi']; else echo ""; ?></textarea>
                                          <br>
                                          Misi
                                          <br>
                                          <textarea id="editor2" class="form-control" rows="10" name="misi" required><?php if(isset($_GET['misi'])) echo $_GET['misi']; else echo ""; ?></textarea>
                                          <br>
                                          Kata Kata
                                          <br>
                                          <textarea class="form-control" name="kata" required><?php if(isset($_GET['kata'])) echo $_GET['kata']; else echo ""; ?></textarea>
                  				<br>
                                          <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                                          <button class="btn btn-default"><i class="fa fa-cancel"></i> Batal</button>
                  			</form>
                  		</div>
                  </div>
                  </div>
		   </div>
	</section>
</section>

<script type="text/javascript">
CKEDITOR.replace('editor1');
CKEDITOR.replace('editor2');
</script>