<?php
	include "sidebar.php";
	include "../config.php";
?>
<section id="main-content">
     <section class="wrapper">
		   <div class="row">
                 <div class="col-md-12 my-container">
                  	<h4>Ketosin 2018 / Peserta / Add</h4>
                  	
                  	<hr class="hr">
                  	
                  	<div class="row">
                 		<div class="col-md-7">
                        <?php
                              if(isset($_GET['error']))
                              {
                                    echo "<div class='alert alert-danger danger'>";
                                    if($_GET['error']=='qr_code')
                                    {
                                          echo "QR Kode Telah Terdaftar";
                                    }
                                    else
                                    {
                                          if($_GET['error']=='terdaftar')
                                          {
                                                echo "Peserta Ini Telah Terdaftar Sebelumnya";
                                          }
                                          else
                                          {
                                                echo "-";
                                          }
                                    }
                                    echo "</div>";
                              }
                        ?>
                 			<form action="act-add-peserta.php" method="post">
                  				Nama Peserta
                  				<br>
                  				<input type="text" name="nama" class="form-control" required />	
                  				<br>
                                          Tipe Peserta
                                          <select name="tipe" class="form-control tipe">
                                                <option>Pilih Tipe</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Siswa">Siswa</option>
                                          </select>
                  				<br>
                                          <div class="hideshow">
                  				Kelas
                  				<br>
                  				<select class="form-control" name="kelas">
                  					<option value="">Pilih Kelas</option>
                  					<option value='X'>X</option>
                  					<option value='XI'>XI</option>
                  					<option value='XII'>XII</option>
                  				</select>
                  				<br>
                  				Jurusan / Paket Keahlian
                  				<br>
                  				<select class="form-control" name="jurusan">
                  					<option value="">Pilih Jurusan</option>
                  					<?php
                  						$sql = mysql_query("select * from jurusan");
                  						while ($data = mysql_fetch_array($sql)) {
                  							echo "<option value='".$data['id']."-$data[nama]'>".$data['nama']."</option>";
                  						}
                  					?>
                  				</select>
                                          <br>
                                          </div>
                                          QR Kode (7 Digit)
                                          <div class="input-group">
                                             <input type="text" class="form-control" name='qr_code'>
                                             <span class="input-group-btn">
                                                  <button class="btn btn-success" type="button" id="auto_qr">Auto QR</button>
                                             </span>
                                          </div>  
                                          <br>
                                          <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                                          <button class="btn btn-default"><i class="fa fa-cancel"></i> Batal</button>
                  		</form>
                  		</div>
                        <div class="col-md-5">
                              ulalal
                        </div>
                  </div>
                  </div>
		   </div>
	</section>
</section>
<script>
      $(document).ready(function(){
            $(".hideshow").hide()
            $('select.tipe').val("Siswa");
            $(".hideshow").show();
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

            $('#auto_qr').click(function() {
              var string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
              var text = "";

              for( var i=0; i < 7; i++ )
                  text += string.charAt(Math.floor(Math.random() * string.length));

              $("[name='qr_code']").val(text);
            })
      })
</script>