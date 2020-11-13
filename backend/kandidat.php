<?php
  include "sidebar.php";
  include "../sys/ORM.php";
  $obj = new ORM;

  $datas = $obj->Select("k.id, k.nama, kelas, foto, j.nama jurusan", "kandidat k join jurusan j on k.id_jurusan = j.id");
?>
      <section id="main-content">
          <section class="wrapper">
			   <div class="row">
                  <div class="col-md-12 my-container">
                  	<h4>Ketosin 2019 / Kandidat Ketua & Wakil Ketua OSIS</h4>
                  	<hr class="hr">
                  	<a href="add-kandidat.php" class="btn btn-success"><i class="fa fa-plus"></i> Add Kandidat</a>
                  	<br><br>
                    <?php
                      foreach ($datas as $data) {
?>
                  	<div class="col-md-4" style="height:375px">
                    <a href="detail-kandidat.php?id=<?php echo $data['id']; ?>">
                    <div class="box text-center" style="margin-bottom : 20px; height:100%">
                        <img src="../assets/kandidat/<?php echo $data['foto'];  ?>" class="img-responsive" style="height : 200px">
                        <hr>
                        <?php echo $data['nama']."<br>".$data['kelas']." ".$data['jurusan']; ?>
                        <br>
                        <br>
                                                  <div class="btn-group">
                            <button class="btn btn-default link-edit" data-url="edit-kandidat.php?id=<?php echo $data['id'] ?>">Edit</button>
                            <button class="btn btn-warning link-hapus" data-url="hapus.php?db=kandidat&id=<?php echo $data['id'] ?>">Hapus</button>
                          </div>

                  	</div>
                    </div>
                    </a>  
<?php
                        }

                    ?>
              	  </div>
              	</div>
          </section>
      </section>

  </body>
</html>
