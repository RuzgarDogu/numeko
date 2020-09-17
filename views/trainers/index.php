<button type="button" class="btn float-right btn-outline-info btn-sm" data-toggle="modal" data-target="#mdl-addTrainer">
  Add a record
</button>

<table class="table table-striped" style="width:100%" id="tbl-trainersList">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Type</th>
      <th>Price</th>
      <th>GSM</th>
      <th>Expertise</th>
      <th>Edit</th>
    </tr>
  </thead>
</table>


<!-- TRAINER EKLEME  FARKLI SAYFA POPUP-->
<div class="modal fade" id="mdl-addTrainer" tabindex="-1" role="dialog" aria-labelledby="mdl-addTrainerLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="trainers/addTrainer" method="post">
				<div class="modal-header">
					<h5 class="modal-title" id="mdl-addTrainerLabel">ADD Trainer</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<!-- seçenekli ekleme  -->
				<div class="modal-body">
					<div class="form-group" id="kutucuklu">
						<label for="type">Trainer Type:</label>
							<select class="custom-select custom-select-lg mb-3" id="trainer_type" name="trainer_type">
									<option value="Full Time">Full Time</option>
									<option value="Freelance">Freelance</option>
									<option value="Company">Company</option>
							</select>

				<!-- düz ekleme  -->
					</div>
					<div class="form-group">
						<label for="trainer_name">Name:</label>
						<input type="text" class="form-control" name="trainer_name" id="trainer_name"  placeholder="Enter Trainer Name">
					</div>
					<div class="form-group">
						<label for="trainer_gsm">GSM Number:</label>
						<input type="text" class="form-control" id="trainer_gsm" name="trainer_gsm" placeholder="Enter GSM Number">
					</div>
					<div class="form-group">
						<label for="trainer_price">Price:</label>
						<input type="text" class="form-control" id="trainer_price" name="trainer_price" placeholder="Price (daily for freelance">
					</div>


					<div class="form-group">
						<p>Trainings Given</p>
              <?php foreach ($this->trainingList as $tl): ?>
								<label><input type="checkbox" name="trexp_add[]" value="<?=$tl['id']?>"><?=$tl['training_name']?></label><br/>
              <?php endforeach; ?>
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




<!-- TRAINER EDIT DUZENLEME SAYFA POPUP-->
<div class="modal fade" id="mdl-editTrainer" tabindex="-1" role="dialog" aria-labelledby="mdl-editTrainerLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="mdl-editTrainerLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<!-- seçenekli ekleme  -->
				<div class="modal-body">
					<div class="form-group" id="kutucuklu">
						<label for="trainer_type_edit">Trainer Type:</label>
							<select class="custom-select custom-select-lg mb-3" id="trainer_type_edit" name="trainer_type_edit">
									<option value="Full Time">Full Time</option>
									<option value="Freelance">Freelance</option>
									<option value="Company">Company</option>
							</select>

				<!-- düz ekleme  -->
					</div>
					<div class="form-group">
						<label for="trainer_name_edit">Name:</label>
						<input type="text" class="form-control" name="trainer_name_edit" id="trainer_name_edit"  placeholder="Enter Trainer Name">
					</div>
					<div class="form-group">
						<label for="trainer_gsm_edit">GSM Number:</label>
						<input type="text" class="form-control" id="trainer_gsm_edit" name="trainer_gsm_edit" placeholder="Enter GSM Number">
					</div>
					<div class="form-group">
						<label for="trainer_price_edit">Price:</label>
						<input type="text" class="form-control" id="trainer_price_edit" name="trainer_price_edit" placeholder="Price (daily for freelance">
					</div>
					<div class="form-group">
            <p>Trainings Given</p>
            <?php foreach ($this->trainingList as $tl): ?>
              <label><input class="trexp_edit" type="checkbox" name="trexp_edit[]" value="<?=$tl['id']?>"><?=$tl['training_name']?></label><br/>
            <?php endforeach; ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
					<button id="btn-saveTrainer" class="btn btn-info">Kaydet</button>
				</div>
		</div>
	</div>
</div>
