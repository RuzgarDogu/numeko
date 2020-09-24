


<div class="card card-info card-tabs">
  <div class="card-header p-0 pt-1">
    <ul class="nav nav-tabs" id="tb-logbook-tab" role="tablist">
      <li class="pt-2 px-3"><a data-toggle="modal" data-target="#mdl-addTraining" href="javascript:void(0)"><h3 class="card-title mr-3"><i class="mr-2 fas fa-plus-circle"></i> Add Record</h3></a></li>
      <li class="nav-item">
        <a class="nav-link active" id="tb-logbook-trainingList-tab" data-toggle="pill" href="#tb-logbook-trainingList" role="tab" aria-controls="tb-logbook-trainingList" aria-selected="true">Training List <i class="text-info fas fa-level-down-alt ml-2"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="tb-logbook-logbook-tab" data-toggle="pill" href="#tb-logbook-logbook" role="tab" aria-controls="tb-logbook-logbook" aria-selected="false">Logbook <i class="text-info fas fa-level-down-alt ml-2"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="tb-logbook-logdata-tab" data-toggle="pill" href="#tb-logbook-logdata" role="tab" aria-controls="tb-logbook-logdata" aria-selected="false">Log Data <i class="text-info fas fa-level-down-alt ml-2"></i></a>
      </li>
      <li id="li-tab1Filter" class="nav-item dropdown ml-auto mr-2">
        <select class="form-control form-control-sm mt-1" id="filtreleme_1">
          <option value="Tümünü Göster">Tümünü Göster</option>
          <option value="İptal">İptal</option>
          <option value="Planlanan">Planlanan</option>
          <option value="Onaylanan">Onaylanan</option>
          <option value="Gerçekleşen">Gerçekleşen</option>
        </select>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="tb-logbook-tabContent">
      <div class="tab-pane fade show active" id="tb-logbook-trainingList" role="tabpanel" aria-labelledby="tb-logbook-trainingList-tab">
        <table class="table" id="tab1_table" style="width:100%">
          <thead>
            <tr>
              <th>Status</th>
              <th>Date</th>
              <th>#</th>
              <th>T. Code</th>
              <th>Company</th>
              <th>Participants</th>
              <th>Valid</th>
              <th>City</th>
              <th>Trainer</th>
              <th>Edit</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tab-pane fade" id="tb-logbook-logbook" role="tabpanel" aria-labelledby="tb-logbook-logbook-tab">
        <table class="table" id="tab2_table" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Training</th>
              <th>Client</th>
              <th>Traine ID</th>
              <th>Trainee</th>
              <th>Certificate</th>
              <th>Trainer</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tab-pane fade" id="tb-logbook-logdata" role="tabpanel" aria-labelledby="tb-logbook-logdata-tab">
        <table class="table" id="tab3_table" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Code</th>
              <th>Training</th>
              <th>Company</th>
              <th>No</th>
              <th>Participant</th>
              <th>Certificate</th>
              <th>Valid</th>
              <th>City</th>
              <th>Trainer</th>
              <th>Trainer</th>
              <th>Duration</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
  <!-- /.card -->
</div>





<!-- Add Training Log -->
<div class="modal fade" id="mdl-addTraining" role="dialog" aria-labelledby="mdl-addTrainingLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form action="logbook/addTraininglog" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="mdl-addTrainingLabel">Add New Training</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group form-group-sm" id="kutucuklu">
                <label for="sl-clients">Select Client</label>
                <select class="custom-select custom-select-lg mb-3" id="sl-clients" name="clients" style="width:100%;">
                  <option></option>
                  <option value="3">Add New Client</option>
                  <?php foreach($this->clients as $v) { ?>
                    <option value="<?=$v['id'];?>"><?=$v['client_name'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" name="date" id="date" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="trainer1">First Trainer</label>
                <select class="custom-select custom-select-lg mb-3" id="trainer1" name="trainer1" required="required">
                  <option value="">Seçiniz...</option>
                  <?php foreach($this->trainers as $v) { ?>
                    <?php if ($v['id'] != 1): ?>
                      <option value="<?=$v['id'];?>"><?=$v['trainer_name'];?></option>
                    <?php endif ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="trainer2">Second Trainer</label>
                <select class="custom-select custom-select-lg mb-3" id="trainer2" name="trainer2">
                  <option value="1">Seçiniz...</option>
                  <?php foreach($this->trainers as $v) { ?>
                    <?php if ($v['id'] != 1): ?>
                      <option value="<?=$v['id'];?>"><?=$v['trainer_name'];?></option>
                    <?php endif ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="city">city:</label>
                <select class="custom-select custom-select-lg mb-3" id="city" name="city" style="width:100%;">
                  <?php foreach($this->cities as $v) { ?>
                    <option value="<?=$v['id'];?>"><?=$v['city'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="training_code">Training Code:</label>
                <select class="custom-select custom-select-lg mb-3" id="training_code" name="training_code" style="width:100%;">
                  <?php foreach($this->trainingList as $v) { ?>
                    <option value="<?=$v['id'];?>"><?=$v['training_code']." > ".$v['training_name'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="tr_status" id="gerceklesen_check" value="2" checked>
            <label class="form-check-label" for="gerceklesen_check">
              Gerçekleşen Eğitim
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="tr_status" id="planlanan_check" value="0">
            <label class="form-check-label" for="planlanan_check">
              Planlanan Eğitim
            </label>
          </div>
          <div class="form-group" id="trainee_box_fg">
            <label for="trainee_box">Trainee List:</label>
            <textarea class="form-control" id="trainee_box" name="trainee_box"></textarea>
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




<!-- Training Edit Modal -->
<div class="modal fade" id="mdl-editTraining" tabindex="-1" role="dialog" aria-labelledby="mdl-editTrainingLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="logbook/editTraining" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="mdl-editTrainingLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group col-sm-6" id="statusAcilir">
              <label for="stati">Eğitim Durumu:</label>
              <select class="custom-select" id="stati" name="stati" style="width:100%;">
                <option value="-1">İptal</option>
                <option value="0">Planlanan</option>
                <option value="1">Onaylanan</option>
                <option value="2">Gerçekleşen</option>
              </select>
            </div>
            <div class="form-group col-sm-6">
              <label for="e_training_code">Training Code:</label>
              <select class="custom-select" id="e_training_code" name="e_training_code" style="width:100%;">
                <?php foreach($this->trainingList as $v) { ?>
                  <option value="<?=$v['id'];?>"><?=$v['training_code']." > ".$v['training_name'];?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-6">
              <label for="date">Date:</label>
              <input type="date" class="form-control" name="datum" id="datum" value="" required>
            </div>
            <div class="form-group col-sm-6">
              <label for="e_trainer1">Trainer:</label>
              <select class="custom-select" id="e_trainer1" name="e_trainer1" required="required">
                <option value="">Seçiniz...</option>
                <?php foreach($this->trainers as $v) { ?>
                  <?php if ($v['id'] != 1): ?>
                    <option value="<?=$v['id'];?>"><?=$v['trainer_name'];?></option>
                  <?php endif ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">

          </div>
          <div class="form-group">
            <label for="e_city">e_city:</label>
            <select class="custom-select" id="e_city" name="e_city" style="width:100%;">
              <?php foreach($this->cities as $v) { ?>
                <option value="<?=$v['id'];?>"><?=$v['city'];?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="e_tr_status" id="e_gerceklesen_check" value="1" checked>
            <label class="form-check-label" for="e_gerceklesen_check">
              Katılımcı Listesi Uygundur
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="e_tr_status" id="e_planlanan_check" value="0">
            <label class="form-check-label" for="e_planlanan_check">
              Katılımcı Listesini Düzenle
            </label>
          </div>
          <div class="form-group" id="e_trainee_box_fg">
            <label for="e_trainee_box">Trainee List:</label>
            <textarea class="form-control" id="e_trainee_box" name="e_trainee_box"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" value="" name="trainingid" id="trainingid">
          <button type="button" id="trainingisil" class="btn mr-auto float-left btn-danger">Bu Eğitimi Sil</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          <button type="submit" class="btn btn-info">Kaydet</button>
        </div>
      </form>

    </div>
  </div>
</div>
