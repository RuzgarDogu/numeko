<div class="card">
  <div class="card-header border-0 bg-info">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">
        <strong>Firma Adı: <span id="spn-compName"> Seçilmedi </span></strong>
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
          <li class="nav-item">
            <a class="btn btn-default btn-sm ml-2 mt-1" href="#" data-toggle="modal" data-target="#mdl-selectClient"> Change Client </a>
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
      <div class="modal-body" style="max-height: 600px; overflow-y: scroll;">
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
      <div class="modal-body"  style="max-height: 600px; overflow-y: scroll;">
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



<!-- Cert Modal -->
<div class="modal fade" id="mdl-certificate" tabindex="-1" role="dialog" aria-labelledby="mdl-certificateLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="height: 595.28px; width: 843.89px; max-width: 843.89px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-certificateLabel">Sertifika</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="printArea">
        <div class="card" id="crd-print">
          <div class="card-body">
            <div class="row">
              <div id="cert-no" class="col-sm-2 offset-sm-2 pl-4 pt-2">82323</div>
              <div class="col-sm-2 offset-sm-6" id="cert-qrcode"></div>
            </div>
            <!-- <div class="row mt-2"></div> -->
            <div class="row mt-4">
              <div id="cert-code" class="col-sm-4 offset-sm-4 text-center text-xs">HS01 - YÜKSEKTE GÜVENLİ ÇALIŞMA</div>
            </div>
            <div class="row mt-5">
              <div class="col-sm-12 mt-4">
                <h2 id="cert-name" class="text-center">Yunus Emre Şahin</h2>
              </div>
            </div>
            <div class="row mt-5"></div>
            <div class="row mt-5"></div>
            <div class="row mt-3">
              <div class="col-sm-2 offset-sm-3">
                <h6 id="cert-egitmen1" class="text-center text-xs">Semi Karabay</h6>
              </div>
              <div class="col-sm-2">
                <h6 id="cert-egitmen2" class="text-center text-xs">Ahmet Yılmazer</h6>
              </div>
              <div class="col-sm-2">
                <h6 class="text-center"></h6>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-sm-4">
                <p class="text-xs"><strong>Eğitim Başarı Belgesi</strong></p>
                <p class="text-xs"><strong>HS01 - Yüksekte Güvenli Çalışma</strong></p>
                <p class="text-xs"><strong>29.08.2020</strong></p>
              </div>
              <div class="col-sm-4"><img src="public/images\Numeko_logo_PNG_min.png" alt="Numeko Logo" class="brand-image" style="opacity: .8"></div>
              <div class="col-sm-4" id="qrcode"></div>
            </div> -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="printcertificate" type="button" class="btn btn-primary">Save as PDF</button>
      </div>
    </div>
  </div>
</div>






<!-- Select Client Modal -->
<div class="modal fade" id="mdl-selectClient" tabindex="-1" role="dialog" aria-labelledby="mdl-selectClientLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-selectClientLabel">Select Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please select a client from the list below...</p>
        <div class="input-group">
          <select id="sl-selectClient" style="width:350px"></select>
          <div class="input-group-append">
            <button id="btn-selectClient" class="btn btn-outline-secondary" type="button">Submit</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
