<?php
	include "sidebar.php";
	include "../sys/ORM.php";
   $obj = new ORM;
   $start = $obj->Select('value', "setting WHERE name = 'start'")[0]['value'];
   $finish = $obj->Select('value', "setting WHERE name = 'finish'")[0]['value'];
?>
<link rel="stylesheet" type="text/css" href="../assets/datetimepicker.css">
<section id="main-content">
     <section class="wrapper">
		   <div class="row">
                 <div class="col-md-12 my-container">
                  	<h4>Ketosin 2019 / Setting</h4>
                  	
                  	<hr class="hr">
                  	
                  	<div class="row">
                 		<div class="col-md-7">
                        <?php
                        if(isset($_GET['error'])) {
                           echo "<div class='alert alert-danger'>";
                              if($_GET['error']=='value') {
                                 echo "<b>Error:</b> Date <u>finish</u> must greater than date <u>start</u>";
                              }
                           echo "</div>";
                        }
                        ?>
                 			<form action="act-setting.php" method="post">
                  				<div class="form-group">
                                 Start
                                  <div class='input-group date dtm'>
                                      <input type='text' class="form-control" name="start" value="<?php echo isset($_GET['start']) ? $_GET['start'] : $start ?>">
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>

                              <div class="form-group">
                                 Finish
                                  <div class='input-group date dtm'>
                                      <input type='text' class="form-control" name="finish" value="<?php echo isset($_GET['finish']) ? $_GET['finish'] : $finish ?>">
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                  </div>
                              </div>
                                          <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
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
<script src="../assets/moment.js"></script>
<script src="../assets/datetimepicker.js"></script>
<script>
      $(document).ready(function(){
         $('.dtm').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'});
      })
</script>