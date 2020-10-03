console.log("Client Info");

$(document).ready(function() {

  $('.editSingleInfo').on('click', function(arguments) {
    let inp = $(this).parent().children('input').eq(0);
    let slc = $(this).parent().children('select').eq(0);
    console.log("aaa",$(this).parent().children('input').eq(0).prop("disabled"));
    inp.prop("disabled",!inp.prop("disabled"));
    slc.prop("disabled",!slc.prop("disabled"));
  })

  $('#sl-vergiDairesiIli').on('change', function(arguments) {
    $('#sl-vergiDairesi').prop("disabled",false);
    $('#sl-vergiDairesi').html("");
    let cty = $(this).val();
    let slicerik = ""
    console.log(cty);
    $.post('clientinfo/getVergiDaireleri', {vergi_plaka: cty}, function(data, textStatus, xhr) {})
    .done(function(data){
      console.log(data);
      slicerik += '<option value="">Seçiniz...</option>';
      data.forEach((item, i) => {
        slicerik += '<option value="'+item.id+'">'+item.vergidairesi+'</option>';
      });
      $('#sl-vergiDairesi').html(slicerik);
    });
  })

  $('#btn-clientinfoSubmit').on('click', function(event) {
    $("form#frm-clientinfo :input").each(function(){
      $(this).prop('disabled',false);
    });
    // $("form#frm-clientinfo :select").each(function(){
    //   $(this).prop('disabled',false);
    // });
    var frmObj = document.getElementById('frm-clientinfo');
    if (frmObj.checkValidity()) {
      event.preventDefault();
      $('#frm-clientinfo').submit();
    }
    // if (!$('#frm-clientinfo').checkValidity()) {
    //   // If the form is invalid, submit it. The form won't actually submit;
    //   // this will just cause the browser to display the native HTML5 error messages.
    //   $('#frm-clientinfo').find(':submit').click()
    // }

    // setTimeout(function(){ $('#frm-clientinfo').submit(); }, 3000);


  })

});
