<?php
    include "sidebar.php"
?>
<style>
.panel-primary{
  border: 1px solid #dddddd;
}
.panel-primary .panel-heading{
  background: #68dff0;
  border: none;
}
</style>
<?php
  include "../sys/ORM.php";
  $obj = new ORM;

  $pemberitahuan = $obj->Select("p.nama as nama_peserta, k.nama as nama_kandidat", "pemilihan as pm JOIN peserta as p on pm.id_peserta = p.id JOIN kandidat as k on pm.id_kandidat = k.id order by pm.id desc limit 5");
?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-md-12 main-chart my-container">
                      <div class="row">
                          <div class="col-md-9">
                            <div class="row">
                    <?php
                      $datas = $obj->Select("k.id, k.nama, kelas, foto, case when p.id is not null then count(*) else 0 end suara, j.nama jurusan", "kandidat k join jurusan j on k.id_jurusan = j.id left join pemilihan p on p.id_kandidat = k.id group by k.id");
                      foreach($datas as $data) {
?>
                    <div class="col-md-4">
                    <a href="detail-kandidat.php?id=<?php echo $data['id']; ?>">
                    <div class="box text-center" style="margin-bottom : 20px">
                        <img src="../assets/kandidat/<?php echo $data['foto'];  ?>" class="img-responsive" style="height : 200px">
                        <h2><?php echo $data['suara']." Suara"; ?></h2>
                        <hr>
                        <?php echo $data['nama']."<br>".$data['kelas']." ".$data['jurusan']; ?>
                        <br>
                        <br>
                    </div>
                    </div>
                    </a>  
<?php } ?>
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="panel panel-primary">
                                  <div class="panel-heading text-center">
                                      Pemberitahuan
                                  </div>
                                  <div class="panel-body">
                                      <?php
                                        foreach($pemberitahuan as $d)
                                        {
                                          echo "<b>".$d['nama_peserta']."</b> telah memilih <b>".$d['nama_kandidat']."</b><hr style='border-top:1px solid #dddddd'>";
                                        }
                                      ?>
                                  </div>
                              </div>
                          </div>
                     </div>
						      </div>
              </div>
          </section>
      </section>
