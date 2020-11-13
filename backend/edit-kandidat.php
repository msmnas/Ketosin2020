<?php
	include "sidebar.php";
  include "../sys/ORM.php";
  $obj = new ORM;

  $data = $obj->Select("k.id, k.nama, visi, misi, slogan, kata, biodata, id_jurusan, kelas, foto, j.nama jurusan", "kandidat k join jurusan j on k.id_jurusan = j.id WHERE k.id = '$_GET[id]'");

  if(count($data) < 1)
    exit();

  $data = $data[0];

  /*if(isset($_GET['id_foto']))
            {
                  $sql = mysql_query("select * from kandidat where id = '$_GET[id_foto]' ");
                 $data = mysql_fetch_array($sql); 
            }
            else
            {
                  $sql = mysql_query("select * from kandidat where id = '$_GET[id]' ");
                  $data = mysql_fetch_array($sql);
            }*/
?>
<section id="main-content">
     <section class="wrapper">
		   <div class="row">
                 <div class="col-md-12 my-container">
                  	<h4>Ketosin 2019 / Kandidat Ketua Osis / Edit</h4>
                  	
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
                 			<form action="update-kandidat.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
                  				Nama Kandidat
                  				<br>
                  				<input type="text" name="nama" value="<?php if(isset($_GET['nama'])) echo $_GET['nama']; else echo $data['nama']; ?>" class="form-control" required>	
                  				<br>
								Foto
                  				<br>
                  				<input type="file" name="foto">
                                          <br>	
                                          <img src="../assets/kandidat/<?php echo $data['foto']; ?>" class="img-responsive" style="max-height : 200px">
                  				<br>
                  				Kelas
                  				<br>
                                          <?php
                                                      if(isset($_GET['kelas']))
                                                      {
                                                            if($_GET['kelas']=="X")
                                                            {
                                                                  $a = "selected";
                                                            }
                                                            else
                                                            {
                                                                  $a = "";
                                                            }

                                                            if($_GET['kelas']=="XI")
                                                            {
                                                                  $b = "selected";
                                                            }
                                                            else
                                                            {
                                                                  $b = "";
                                                            }
                                                            
                                                            if($_GET['kelas']=="XII")
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
                                                            if($data['kelas']=="X")
                                                            {
                                                                  $a = "selected";
                                                            }
                                                            else
                                                            {
                                                                  $a = "";
                                                            }

                                                            if($data['kelas']=="XI")
                                                            {
                                                                  $b = "selected";
                                                            }
                                                            else
                                                            {
                                                                  $b = "";
                                                            }
                                                            
                                                            if($data['kelas']=="XII")
                                                            {
                                                                  $c = "selected";
                                                            }
                                                            else
                                                            {
                                                                  $c = "";
                                                            }
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
                                                            if(isset($_GET['jurusan']))
                                                            {
                                                                  if($jurusan['id']==$_GET['jurusan'])
                                                                  {
                                                                        $selected = "selected";
                                                                  }
                                                                  else
                                                                  {
                                                                        $selected = "";
                                                                  }
                                                            }
                                                            else
                                                            {
                                                                  if($jurusan['id']==$data['id_jurusan'])
                                                                  {
                                                                        $selected = "selected";
                                                                  }
                                                                  else
                                                                  {
                                                                        $selected = "";
                                                                  }
                                                            }
                  							echo "<option value='".$jurusan['id']."' $selected>".$jurusan['nama']."</option>";
                  						}
                  					?>
                  				</select>
                  				<br>
                  				Slogan
                  				<br>
                  				<input type='text' class="form-control" name="slogan" required value='<?php if(isset($_GET['slogan'])) echo $_GET['slogan']; else echo $data['slogan']; ?>'></textarea>
                  				<br>
                  				Visi
                  				<br>
                  				<textarea id="editor2" class="form-control" rows="10" name="visi" required><?php if(isset($_GET['visi'])) echo $_GET['visi']; else echo $data['visi']; ?></textarea>
                                          <br>
                                          Misi
                                          <br>
                                          <textarea id="editor1" class="form-control" rows="10" name="misi" required><?php if(isset($_GET['misi'])) echo $_GET['misi']; else echo $data['misi']; ?></textarea>
                                          <br>
                                          Kata Kata
                                          <br>
                                          <textarea class="form-control" name="kata" required><?php if(isset($_GET['kata'])) echo $_GET['kata']; else echo $data['kata']; ?></textarea>
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