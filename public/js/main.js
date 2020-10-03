$(document).ready(function() {
  console.log("Main js sayfası");

  $(document).on('click', '#user-logout', (arguments) => {
    if (confirm("Çıkış yapmak istediğinize emin misiniz?")) {
      return true;
    }
    return false;
  })

  const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);
  if (!isInStandaloneMode()) {
    $('#btnAdd').prop('disabled', true);
    $('#btnAdd').html('Uygulama Yüklendi');
  }

  $.post('users/getCurrentUserDetails', function(data, textStatus, xhr) { })
  .done(function(d){
    console.log(d);

    $('#inp-company').val(d.client_name);
    $('#inp-name').val(d.user_name);
    $('#inp-surname').val(d.user_surname);
    $('#inp-email').val(d.email);
    $('#inp-telephone').val(d.telefon);
    $('#inp-username').val(d.login);


  });

  let passChangeProfile = 0
  $(document).on('click', '#btn-changePasswordProfile', function(arguments) {
    if (Math.abs(passChangeProfile) == 0) {
      $('.frg-pwd').css("display","block")
      $(this).text("Cancel")
      passChangeProfile += -1
      // if ($('#ed-inpPwd2').val() != $('#ed-inpPwd1').val()) {
      //   $('#ed-btn-saveUser').prop("disabled","disabled")
      // } else {
      //   $('#ed-btn-saveUser').prop("disabled","")
      // }
    } else {
      $('.frg-pwd').css("display","none")
      $(this).text("Change Password")
      passChangeProfile += -1
      // $('#ed-btn-saveUser').prop("disabled","")
      // $('.chkpwd').val("")
    }
    passChangeProfile = Math.abs(passChangeProfile)
    console.log(passChangeProfile);
  })

  $(document).on('keyup','.chkpwdprofile', function(){
    if ($('#inp-pwd2profile').val() != $('#inp-pwd1profile').val()) {
      $('#btn-saveProfile').prop("disabled","disabled")
    } else {
      $('#btn-saveProfile').prop("disabled","")
    }
    if (Math.abs(passChangeProfile) == 1) {
      if ($('#inp-pwd2profile').val() != $('#inp-pwd1profile').val()) {
        $('#btn-saveProfile').prop("disabled","disabled")
      } else {
        $('#btn-saveProfile').prop("disabled","")
      }
    } else{
      $('#btn-saveProfile').prop("disabled","")
    }
  })

});
