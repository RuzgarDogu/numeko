<button type="button" class="btn float-right btn-outline-info btn-sm" data-toggle="modal" data-target="#mdl-addAsset">
  Add a record
</button>

<table class="table table-striped" style="width:100%" id="tbl-assetsList">
  <thead>
    <tr>
      <th>#</th>
      <th>Type</th>
      <th>Brand</th>
      <th>Model</th>
      <th>Serial</th>
      <th>Valid Until</th>
      <th>Delete</th>
      <th>Maintenance</th>
    </tr>
  </thead>
</table>

<!-- Add Maintenance-->
<div class="modal fade" id="mdl-addMaint" tabindex="-1" role="dialog" aria-labelledby="mdl-addMaintLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="assets/addMaintenance" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-addMaintLabel">Add Maintenance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="form-group">
		    <label for="bakimciadi">Maintainer:</label>
		    <input type="text" class="form-control" id="bakimciadi" name="bakimciadi" placeholder="Enter Name...">
		 </div>
		 <div class="form-group">
		    <label for="bakimtarihi">Maintenance Date:</label>
		    <input type="date" class="form-control" id="bakimtarihi" name="bakimtarihi" placeholder="Enter a Model">
		 </div>
		 <div class="form-group">
		    <label for="bakimvalid">Maintenance Valid Until:</label>
		    <input type="date" class="form-control" id="bakimvalid" name="bakimvalid" placeholder="Enter a Model">
		 </div>
		 <input type="hidden" name="h_assetid" id="h_assetid" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-info">Kaydet</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Add Asset -->
<!-- Modal -->
<div class="modal fade" id="mdl-addAsset" tabindex="-1" role="dialog" aria-labelledby="mdl-addAssetLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form action="assets/addAsset" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-addAssetLabel">Add Asset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="form-group" id="kutucuklu">
		    <label for="type">Type:</label>
			<?php if ($this->assetTypes) { ?>
			    <select class="custom-select custom-select-lg mb-3" id="sl-type" name="type">
				<?php foreach($this->assetTypes as $type) { ?>
			  		<option value="<?=$type['astid'];?>"><?=$type['type_name'];?></option>
				<?php } ?>
				<option value="3">Diğer</option>
			</select>
			<?php } ?>
		  </div>
		<div class="form-group">
		    <label for="brand">Brand:</label>
		    <input type="text" class="form-control" name="brand" id="brand"  placeholder="Enter a Brand">
		  </div>
		  <div class="form-group">
		    <label for="model">Model:</label>
		    <input type="text" class="form-control" id="model" name="model" placeholder="Enter a Model">
		  </div>
		  <div class="form-group">
		    <label for="serino">Serial No:</label>
		    <input type="text" class="form-control" id="serino" name="serino" placeholder="Enter Serial No">
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-info">Kaydet</button>
      </div>
      </form>
    </div>
  </div>
</div>
