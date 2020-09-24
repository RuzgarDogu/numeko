
<div class="card">
  <div class="card-header border-0 bg-info">
    <div class="d-flex justify-content-between">
      <h3 class="card-title"><strong>Firma Adı: <span id="spn-compName"></span></strong>
      </h3>
      <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
          <li class="nav-item">
            <select class="form-control form-control-sm mt-1 text-xs" id="filtreleme_1">
              <option value="100">Tümünü Göster</option>
              <option value="0">Onay Bekleyen Eğitimler</option>
              <option value="1">Planlanmış Eğitimler</option>
              <option value="2">Gerçekleşen Eğitimler</option>
            </select>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="card-body pl-0 pt-0 pr-0">
    <table id="tbl-clientData" class="table table-striped" style="width:100%;">
      <thead>
        <tr>
          <th>Status</th>
          <th>Status</th>
          <th>Date</th>
          <th>T. Code</th>
          <th>T. Name</th>
          <!-- <th>Trainer</th> -->
          <th># Participant</th>
          <th>Duration</th>
          <th>City</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="mdl-approve" tabindex="-1" role="dialog" aria-labelledby="mdl-approveLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h5 class="modal-title" id="mdl-approveLabel">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="text-sm nav-link active" id="pills-trList-tab" data-toggle="pill" href="#pills-trList" role="tab" aria-controls="pills-trList" aria-selected="true">Training List</a>
            </li>
            <li class="nav-item">
              <a class="text-sm nav-link" id="pills-checkList-tab" data-toggle="pill" href="#pills-checkList" role="tab" aria-controls="pills-checkList" aria-selected="false">Checklist</a>
            </li>
          </ul>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-trList" role="tabpanel" aria-labelledby="pills-trList-tab">
            <table class="table table-sm" id="traineeCheckList"></table>
            <div id="bulkdata"></div>
          </div>
          <div class="tab-pane fade" id="pills-checkList" role="tabpanel" aria-labelledby="pills-checkList-tab">
            <div id="check_approve_list">
              <label class="text-xs"><input class="mr-2" type="checkbox" value="">Eğitim yeri ve saati katılımcılara gönderildi mi?</label>
              <label class="text-xs"><input class="mr-2" type="checkbox" value="">Katılımcılar iş güvenliği ayakkabıları ile eğitime gitmesi konusunda uyarıldı mı?</label>
              <label class="text-xs"><input class="mr-2" type="checkbox" value="">Katılımcıların sağlık raporları mevcut mudur?</label>
              <label class="text-xs"><input class="mr-2" type="checkbox" value="">Eğitim kapsamında fobi ya da panik atağı olan var mıdır?</label>
              <label class="text-xs"><input class="mr-2" type="checkbox" value="">Katılımcı personel eğitmenin talimatlarına uymak konusunda uyarıldı mı?</label>
              <label class="text-xs"><input class="mr-2" type="checkbox" value="">Sertifikaları kimin alması gerektiğini bildirdiniz mi? </label>
              <label class="text-xs"><input class="mr-2" type="checkbox" value="">Eğitimden ayrılan personel tekrar katılamaz. Lütfen katılımcıları bilgilendiriniz.</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="inp-tid" name="inp-tid" value="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btn-approveList" type="button" class="btn btn-primary">Approve List</button>
      </div>
    </div>
  </div>
</div>



<!-- List Modal -->
<div class="modal fade" id="mdl-traineeList" tabindex="-1" role="dialog" aria-labelledby="mdl-traineeListLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-traineeListLabel">-</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Cert No</th>
            </tr>
          </thead>
          <tbody id="tb-traineeList">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
