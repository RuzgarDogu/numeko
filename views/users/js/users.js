console.log("Users table sayfasındayız");


$(document).ready(function() {

  var tbl_userstable;
  var btn_editUser = '<button type="button" data-toggle="modal" data-target="#mdl-editUser" class="btn-sm btn-editUser btn btn-default mr-2"><i class="text-info fas fa-edit" aria-hidden="true"></i></button>';
      btn_editUser += '<button type="button" class="btn-sm btn-deleteUser btn btn-default mr-2"><i class="text-danger far fa-trash-alt" aria-hidden="true"></i></button>';

  $.post('users/getAllUsers', function(data, textStatus, xhr) {})
  .done(function(d){
    console.log("d",d);
    tbl_userstable = $('#tbl-userstable').DataTable( {
      "data": d,
      "columns": [
        {"data":"userid"},
        {"data":"login"},
        {"data":"role"},
        {"data":"user_name"},
        {"data":"user_surname"},
        {"data":null},
        {"data":null},
      ],
      "columnDefs": [
        {
          "targets": -1,
          "render": function(data) {
            console.log(data);
            if (data.role == "owner") {
              return "-"
            } else {
              return btn_editUser
            }
          }
        },
        {
          "targets": -2,
          "render": function(data) {
            console.log(data);
            if (data.role == "owner") {
              return "-"
            } else {
              return data.client
            }
          }
        }
      ],
      "dom": 'lrtip'
    })
  });

  $(document).on('change','#sl-role', function(event) {
    console.log($(this).val());
    if ($(this).val() == "client") {
      $('#frg-client').css("display","block");
      $('#sl-client').prop("required","required");
    } else {
      $('#frg-client').css("display","none");
      $('#sl-client').prop("required","");
    }
  })


  $(document).on('click','.btn-editUser', function(e) {
    let usr = tbl_userstable.row( $(this).closest('tr ') ).data()
    console.log(usr);
    $('#mdl-editUserLabel').text(usr.user_name+" "+usr.user_surname)
    $('#ed-username').val(usr.user_name)
    $('#ed-usersurname').val(usr.user_surname)
    $('#ed-login').val(usr.login)
    $('#inp-ed-id').val(usr.userid)
    $('#ed-sl-role option').each(function(index, el) {
        if ($(this).val()==usr.role) {
            $(this).attr('selected', true);
        } else {
            $(this).attr('selected', false);
        }
    });
  });

  $(document).on('click','.btn-deleteUser', function(e) {
    let usr = tbl_userstable.row( $(this).closest('tr ') ).data()
    if (usr.role == "owner") {
      alert("Bu kişiyi silemezsiniz, gücünüz yetmez");
    } else {
      let mesaj = usr.client + " Firmasından" + usr.user_name + " " + usr.user_surname +" kullanıcısını silmek istediğinizden emin misiniz?";
      if (confirm(mesaj)) {
        $.post('users/deleteUser', {uid: usr.userid}, function(data, textStatus, xhr) {})
        .done(function(e){
          location.reload();
        });
      }
    }
  })

  let passChange = 0
  $(document).on('click', '#btn-changePassword', function(arguments) {
    if (Math.abs(passChange) == 0) {
      $('#rw-editPassword').css("display","flex")
      $(this).text("Cancel")
      passChange += -1
      if ($('#ed-inpPwd2').val() != $('#ed-inpPwd1').val()) {
        $('#ed-btn-saveUser').prop("disabled","disabled")
      } else {
        $('#ed-btn-saveUser').prop("disabled","")
      }
    } else {
      $('#rw-editPassword').css("display","none")
      $(this).text("Change Password")
      passChange += -1
      $('#ed-btn-saveUser').prop("disabled","")
      $('.chkpwd').val("")
    }
    passChange = Math.abs(passChange)
    console.log(passChange);
  })

  $(document).on('keyup','.chkpwd', function(){
    if ($('#inpPwd2').val() != $('#inpPwd1').val()) {
      $('#btn-saveUser').prop("disabled","disabled")
    } else {
      $('#btn-saveUser').prop("disabled","")
    }
    if (Math.abs(passChange) == 1) {
      if ($('#ed-inpPwd2').val() != $('#ed-inpPwd1').val()) {
        $('#ed-btn-saveUser').prop("disabled","disabled")
      } else {
        $('#ed-btn-saveUser').prop("disabled","")
      }
    } else{
      $('#ed-btn-saveUser').prop("disabled","")
    }
  })

});
