<!-- Modal -->
<div class="modal fade" id="mdl-editProfile" tabindex="-1" role="dialog" aria-labelledby="mdl-editProfileLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="users/editUserProfile" method="post">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="mdl-editProfileLabel">Profili Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>COMPANY</label>
                <input id="inp-company" name="inp-company" type="text" class="form-control" placeholder="Enter ..." disabled="disabled">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>NAME</label>
                <input id="inp-name" name="inp-name" type="text" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>SURNAME</label>
                <input id="inp-surname" name="inp-surname" type="text" class="form-control" placeholder="Enter ...">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>EMAIL</label>
                <input id="inp-email" name="inp-email" type="email" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>PHONE</label>
                <input id="inp-telephone" name="inp-telephone" type="tel" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group">
                <label>USERNAME</label>
                <input id="inp-username" name="inp-username" type="text" class="form-control" placeholder="Enter ...">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <!-- text input -->
              <div class="form-group frg-pwd" style="display:none;">
                <label>PASSWORD</label>
                <input id="inp-pwd1profile" name="inp-pwdProfile" type="text" class="form-control chkpwdprofile" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group frg-pwd" style="display:none;">
                <label>PASSWORD</label>
                <input id="inp-pwd2profile" type="text" class="form-control chkpwdprofile" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label style="color:white;">CHANGE PASSWORD</label>
                <button id="btn-changePasswordProfile" type="button" class="btn btn-block mb-2 mr-auto float-left btn-outline-info">Change Password</button>
              </div>
              <!-- text input -->
              <!-- <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control" placeholder="Enter ...">
              </div> -->
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btn-saveProfile" type="submit" class="btn btn-primary">Save changes</button>
        <input type="hidden" name="uri" value="<?=$_SERVER['REQUEST_URI'];?>">
      </div>
    </form>
    </div>
  </div>
</div>
<!-- content ends here -->
</div>
</section>
</div>
<!-- Content Wrapper END-->
</div>

</body>
</html>
