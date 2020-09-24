<button type="button" class="btn float-right btn-outline-info btn-sm" data-toggle="modal" data-target="#mdl-addUser">
  Add User
</button>
<table class="table table-striped" id="tbl-userstable" style="width:100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Login</th>
      <th>Role</th>
      <th>Name</th>
      <th>Surname</th>
      <th>Company</th>
      <th>Action</th>
    </tr>
  </thead>
</table>

<!-- Modal -->
<div class="modal fade" id="mdl-addUser" tabindex="-1" role="dialog" aria-labelledby="mdl-addUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" action="users/addUser" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-addUserLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Name</label>
                <input name="username" type="text" class="form-control" placeholder="Enter Name..." required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Surname</label>
                <input name="usersurname" type="text" class="form-control" placeholder="Enter Surname..." required="required">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Login</label>
                <input name="login" type="text" class="form-control" placeholder="Enter Login..." required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Role</label>
                <select class="custom-select" id="sl-role" name="role" required="required">
                  <option value="">Seçiniz...</option>
                  <option value="client">Client</option>
                  <option value="default">Default</option>
                  <option value="editor">Editor</option>
                  <option value="admin">Admin</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Password</label>
                <input id="inpPwd1" name="pwd" type="text" class="chkpwd form-control" placeholder="Enter Password..." required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <input id="inpPwd2" type="text" class="chkpwd form-control" placeholder="Confirm Password..." required="required">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <div class="form-group" id="frg-client" style="display:none;">
              <label>Company</label>
              <select class="custom-select" id="sl-client" name="client">
                <option value="">Seçiniz...</option>
                <?php foreach ($this->clients as $c) { ?>
                  <option value="<?=$c['id']?>"><?=$c['client_name']?></option>
                <?php } ?>
                </select>
            </div>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btn-saveUser" type="submit" class="btn btn-primary" disabled="disabled">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="mdl-editUser" tabindex="-1" role="dialog" aria-labelledby="mdl-editUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" action="users/editUser" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-editUserLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Name</label>
                <input id="ed-username" name="ed-username" type="text" class="form-control" placeholder="Enter Name..." required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Surname</label>
                <input id="ed-usersurname" name="ed-usersurname" type="text" class="form-control" placeholder="Enter Surname..." required="required">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Login</label>
                <input id="ed-login" name="ed-login" type="text" class="form-control" placeholder="Enter Login..." required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Role</label>
                <select class="custom-select" id="ed-sl-role" name="ed-role" required="required">
                  <option value="">Seçiniz...</option>
                  <option value="client">Client</option>
                  <option value="default">Default</option>
                  <option value="editor">Editor</option>
                  <option value="admin">Admin</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="row" id="rw-editPassword" style="display:none">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Password</label>
                <input id="ed-inpPwd1" name="ed-pwd" type="text" class="chkpwd form-control" placeholder="Enter Password...">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <input id="ed-inpPwd2" type="text" class="chkpwd form-control" placeholder="Confirm Password...">
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input name="inp-ed-id" id="inp-ed-id" type="hidden" name="" value="">
        <button id="btn-changePassword" type="button" class="btn mr-auto float-left btn-outline-info">
          Change Password
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="ed-btn-saveUser" type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
