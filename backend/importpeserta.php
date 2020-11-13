


<div class="modal-dialog">
    <div class="modal-content">

    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Import File</h4>
        </div>

        <div class="modal-body">
        	<div class="row">
        	<div class="col-md-10">
                     <h2>Import Peserta</h2>
                    <div class="col-md-9">
  						
          <label>Pilih File</label>
          <form name="myForm" id="myForm" onSubmit="return validateForm()" action="proses.php" method="post" enctype="multipart/form-data">
              <input type="file" id="filesiswaall" name="filesiswaall" required="" /><br>
              <label><a href="template.php"><div class="btn btn-info btn-sm">Download Template</div></a></label>
              <input type="submit" name="submit" value="Import" class="btn btsn-block  btn-success"/><br/>
          </form>
					</div>

          </div>
          
        </div>
       </div>
       </div>