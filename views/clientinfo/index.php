<?php
// echo '<pre>' . var_export($this->clientData, true) . '</pre>';
// echo '<pre>' . var_export($this->vergidaireleri, true) . '</pre>';
$c = $this->clientData;
?>
<div class="row">
  <div class="col-sm-3">
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="public/images/defaultuserimage.png" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center"><?=$c['userdetails']['user_name']." ".$c['userdetails']['user_surname']?></h3>

        <p class="text-muted text-center"><?=$c['userdetails']['user_position']?></p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Telefon</b> <a class="float-right"><?=$c['userdetails']['telefon']?></a>
          </li>
          <li class="list-group-item">
            <b>Email</b> <a class="float-right"><?=$c['userdetails']['email']?></a>
          </li>
          <li class="list-group-item">
            <b>Company</b> <a class="float-right"><?=$c['companyinfo']['client_name']?></a>
          </li>
        </ul>

        <a href="#" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#mdl-editProfile"><b>Edit User Profile</b></a>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
  <div class="col-sm-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#tb-companyInfo" data-toggle="tab">Company Info</a></li>
          <li class="nav-item"><a class="nav-link" href="#tb-statistics" data-toggle="tab">Statistics</a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> -->
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="tb-companyInfo">
            <form id="frm-clientinfo" class="" action="clientinfo/editClient" method="post">
              <div class="row mb-3">
                <div class="callout callout-danger col-sm-12">
                  <h5><i class="fas fa-info"></i> Bilgilendirme:</h5>
                  Sizlere daha iyi hizmet verebilmemiz adına aşağıda bulunan formun eksiksiz doldurulması gerekmektedir. Eğer aşağıdaki bilgileriniz ile güncel bilgileriniz eşleşmiyorsan lütfen bu bilgileri güncelleyin. Her bir kutucuğun sağında bulunan düzenleme butonuna basarak gerekli işlemleri yapabilirsiniz.
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <label>Firma Kısa Adı</label>
                  <div class="input-group mb-3">
                    <input name="client_name" type="text" class="form-control" value="<?=$c['companyinfo']['client_name']?>" disabled="disabled">
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8">
                  <label>Firma Ünvanı</label>
                  <div class="input-group mb-3">
                    <input name="client_longname" type="text" class="form-control" value="<?=$c['companyinfo']['client_longname']?>" disabled="disabled">
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <label>Şehir</label>
                  <div class="input-group mb-3">
                    <select name="city" class="form-control" disabled="disabled">
                      <?php foreach ($this->cities as $key => $value) : ?>
                        <?php if ($value['id'] == $c['companyinfo']['client_plaka']) { ?>
                          <option value="<?=$value['id']?>" selected="selected"><?=$value['city']?></option>
                        <?php } else { ?>
                          <option value="<?=$value['id']?>"><?=$value['city']?></option>
                        <?php } ?>
                      <?php endforeach ?>
                    </select>
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8">
                  <label>Adres</label>
                  <div class="input-group mb-3">
                    <input name="client_address" type="text" class="form-control" value="<?=$c['companyinfo']['client_address']?>" disabled="disabled">
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <label>Telefon</label>
                  <div class="input-group mb-3">
                    <input name="client_phone" type="text" class="form-control" value="<?=$c['companyinfo']['client_phone']?>" disabled="disabled">
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <label>Web Sitesi</label>
                  <div class="input-group mb-3">
                    <input name="client_webpage" type="text" class="form-control" value="<?=$c['companyinfo']['client_webpage']?>" disabled="disabled">
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <label>Email</label>
                  <div class="input-group mb-3">
                    <input name="email" type="text" class="form-control" value="<?=$c['userdetails']['email']?>" disabled="disabled">
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <label>Vergi Dairesi İli</label>
                  <div class="input-group mb-3">
                    <select id="sl-vergiDairesiIli" name="vergi_plaka" class="form-control" disabled="disabled">
                      <?php foreach ($this->cities as $key => $value) : ?>
                        <?php if ($value['id'] == $c['companyinfo']['vergi_plaka']) { ?>
                          <option value="<?=$value['id']?>" selected="selected"><?=$value['city']?></option>
                        <?php } else { ?>
                          <option value="<?=$value['id']?>"><?=$value['city']?></option>
                        <?php } ?>
                      <?php endforeach ?>
                    </select>
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <label>Vergi Dairesi</label>
                  <div class="input-group mb-3">
                    <select id="sl-vergiDairesi" name="vergi_dairesi" class="form-control" disabled="disabled" required="required">
                      <?php foreach ($this->vergidaireleri as $key => $value) : ?>
                        <?php if ($value['id'] == $c['companyinfo']['vergi_dairesi']) { ?>
                          <option value="<?=$value['id']?>" selected="selected"><?=$value['vergidairesi']?></option>
                        <?php } else { ?>
                          <option value="<?=$value['id']?>"><?=$value['vergidairesi']?></option>
                        <?php } ?>
                      <?php endforeach ?>
                    </select>
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <label>Vergi No</label>
                  <div class="input-group mb-3">
                    <input name="vergi_no" type="text" class="form-control" value="<?=$c['companyinfo']['vergi_no']?>" disabled="disabled">
                    <div class="input-group-append editSingleInfo">
                      <span class="input-group-text"><i class="text-info fas fa-edit"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <input type="hidden" value="<?=$c['companyinfo']['id']?>" name="client_id" value="">
                <button id="btn-clientinfoSubmit" type="submit" class="mt-3 btn btn-info">Submit Changes</button>
              </div>
            </form>
          </div>
          <div class="tab-pane" id="tb-statistics"></div>
          <!-- <div class="tab-pane"></div> -->
        </div>
      </div>
    </div>
  </div>
</div>
