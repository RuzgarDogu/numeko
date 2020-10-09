console.log("Clients Portal");

$(document).ready(function() {

  var tid, nop

  $.post('users/getCurrentUser', function(data, textStatus, xhr) {})
  .done(function(u){
    console.log("Userid",parseInt(u));
    getClientData(parseInt(u))
  });


  const getClientData = (uid) => {

    var tbl_clientData;
    var btn_approve = '<button type="button" class="btn-xs btn-block btn-approveTraining btn btn-success" data-toggle="modal" data-target="#mdl-approve">Approve</button>';
    var btn_list = '<button type="button" class="btn-xs btn-block btn-traineeList btn btn-info" data-toggle="modal" data-target="#mdl-traineeList">List</button>';


    $.post('clientsportal/getClientLogData', {uid: uid}, function(data, textStatus, xhr) {})
    .done(function(data){
      console.log(data);
      $('#spn-compName').html(data[0].client_name)
      tbl_clientData = $('#tbl-clientData').DataTable( {
        "data": data,
        "columns": [
          {"data":"status"},
          {"data": function(data){
            let status
            if (data.status == "0") {
              status = '<small class="badge badge-success p-2">Onay Bekleyen</small>'
            } else if (data.status == "1") {
              status = '<small class="badge badge-info p-2">Planlanmış</small>'
            } else if (data.status == "2") {
              status = '<small class="badge badge-secondary p-2">Gerçekleşen</small>'
            } else {
              status = "-"
            }
            return status
          }
        },
        {"data":"training_date"},
        {"data":"training_code"},
        {"data":"training_name"},
        // {"data":"trainer_name"},
        {"data":"nop"},
        {"data":"training_duration"},
        {"data":"city"},
        {"data":null}
      ],
      "columnDefs": [
        { "visible": false, "targets": 0 },
        {
          "targets": -1,
          "sortable": false,
          "render": function ( data, type, full, meta ) {
            let btnEdit
            if (data.status ==  0) {
              btnEdit = btn_approve
            } else {
              btnEdit = btn_list
            }
            return btnEdit
          }
        }
      ],
      "dom": 'rtip'
    })

    $(document).on('change','#filtreleme_1',function(){
      var selectedValue = $(this).val();
      if ($(this).val() == 100) {
        tbl_clientData.column(0).search("").draw();
      } else {
        tbl_clientData.column(0).search(selectedValue).draw();
      }
    });

    $(document).on('click','.btn-traineeList',function(){
      trainingData = tbl_clientData.row( $(this).closest('tr ') ).data()
      console.log(trainingData);
      $('#mdl-traineeListLabel').html("<strong>"+trainingData.training_name+"</strong> Eğitimi")
      let tb_traineeList = ""
      trainingData.participants.forEach((item, i) => {

        let certbox = "<span class='text-success mr-2'>"+item.cert_no+"</span><button data-toggle='modal' data-target='#mdl-certificate' data-tid='"+trainingData.id+"' data-id='"+item.id+"' class='btn btn-outline-primary btn-xs viewcert'>view</button>";
        let certno = item.cert_no != "" ? certbox : "<span class='text-danger'>Henüz Oluşturulmadı</span>";
        tb_traineeList += "<tr>";
          tb_traineeList += "<td>"+item.trainee_id+"</td>";
          tb_traineeList += "<td>"+item.trainee_name+"</td>";
          tb_traineeList += "<td>"+certno+"</td>";
        tb_traineeList += "</tr>";
      });
      $('#tb-traineeList').html(tb_traineeList)
    });


    $(document).on('click','.btn-approveTraining',function(){
      $('#pills-trList-tab').trigger('click');
      trainingData = tbl_clientData.row( $(this).closest('tr ') ).data()
      console.log(trainingData);
      tid = trainingData.id;
      nop = trainingData.nop;
      let veriler = trainingData.participants == 'null' ? new Array() : trainingData.participants;
      console.log("eeeee",veriler);
      var icerik = "";
      if (veriler.length) {
        icerik += "<tbody>";
        for(var i = 0; i<veriler.length; i++){
          icerik += "<tr id='"+veriler[i].id+"'>";
          icerik += "<td>"+(i+1)+"</td>";
          // icerik += "<td><input class='form-control-sm traineeInput form-control' type='text' value='"+veriler[i].trainee_name+"'></td>";
          icerik += '<td><div class="input-group">'
          icerik += '<input type="text" value="'+veriler[i].trainee_name+'" class="traineeInput form-control form-control-sm">'
          icerik += '<div class="input-group-append">'
          icerik += '<span class="deletetrainee input-group-text"><i class="text-danger fas fa-trash"></i></span>'
          icerik += '</div>'
          icerik += '</div></td>';
          icerik += "</tr>";
        }
        icerik += "<tr id='eklemesatiri'>";
        icerik += "<td><button value='"+(i+1)+"' id='addtraineerow' class='btn btn-primary' type='button'><i class='fas fa-plus'></i></button></td>";
        icerik += "<td><button class='btn btn-secondary' id='bulkedit' type='button'>Bulk Edit</button></td>";
        // icerik += "<td><button value='"+(i+1)+"' id='addtraineerow' class='btn btn-primary' type='button'><i class='fas fa-plus'></i></button></td>";
        icerik += "</tr>";
        icerik += "</tbody>";
        $('#traineeCheckList').html(icerik);
        $('#bulkdata').html('')
      } else {
        var textareaicerik = ""
        textareaicerik += '<h3>Please add your trainee list (Copy paste enabled)';
        textareaicerik += '<textarea class="form-control" id="trainee_box" name="trainee_box"></textarea>';
        textareaicerik += "<button class='btn btn-success' id='addbulkdata' type='button'>Confirm List</button>";
        $('#bulkdata').html(textareaicerik);
        $('#traineeCheckList').html('');
      }









      $(document).on('click', '#addbulkdata', function(event) {
        var ta = $('#trainee_box').val();
        var arr = ta.split('\n');
        var icerik = "";
        if (arr.length) {
          icerik += "<thead>";
          icerik += "<tr>";
          icerik += "<th>No</th>";
          icerik += "<th>Name</th>";
          icerik += "</tr>";
          icerik += "</thead>";
          icerik += "<tbody>";
          for(var i = 0; i<arr.length; i++){
            icerik += "<tr id='"+arr[i]+"'>";
            icerik += "<td>"+(i+1)+"</td>";
            icerik += '<td><div class="input-group">'
            icerik += '<input type="text" value="'+arr[i]+'" class="traineeInput form-control form-control-sm">'
            icerik += '<div class="input-group-append">'
            icerik += '<span class="deletetrainee input-group-text"><i class="text-danger fas fa-trash"></i></span>'
            icerik += '</div>'
            icerik += '</div></td>';
            icerik += "</tr>";
          }
          icerik += "<tr id='eklemesatiri'>";
          icerik += "<td><button value='"+(i+1)+"' id='addtraineerow' class='btn btn-primary' type='button'><i class='fas fa-plus'></i></button></td>";
          icerik += "<td><button class='btn btn-secondary' id='bulkedit' type='button'>Bulk Edit</button></td>";
          // icerik += "<td><button value='"+(i+1)+"' id='addtraineerow' class='btn btn-primary' type='button'><i class='fas fa-plus'></i></button></td>";
          icerik += "</tr>";
          icerik += "</tbody>";
          $('#traineeCheckList').html(icerik);
          $('#bulkdata').html('');
        }

      });




      $(document).on('click', '#btn-approveList', function(arguments) {
        $('#pills-checkList-tab').trigger('click');
        $('#btn-approveList').html('Save List');
        $('#btn-approveList').attr('id','btn-saveList');
        var chlen = $("#check_approve_list input:checked").length;
        if (chlen > 6) {
          $('#btn-saveList').prop('disabled',false);
        } else {
          $('#btn-saveList').prop('disabled',true);
        }
      })

      $(document).on('click', '#pills-trList-tab', function(arguments) {
        $('#btn-saveList').html('Approve List');
        $('#btn-saveList').attr('id','btn-approveList');
        $('#btn-approveList').prop('disabled',false);
      })

      $(document).on('click', '#pills-checkList-tab', function(arguments) {
        $('#btn-approveList').html('Save List');
        $('#btn-approveList').attr('id','btn-saveList');
        var chlen = $("#check_approve_list input:checked").length;
        if (chlen > 6) {
          $('#btn-saveList').prop('disabled',false);
        } else {
          $('#btn-saveList').prop('disabled',true);
        }
      })

    });

  });

  $('#inp-globalSearch').keyup(function(){
    tbl_clientData.search($(this).val()).draw() ;
  })

}

$(document).on('click', '.deletetrainee', function(event) {
  console.log("asdfasdfasdf");
  var row = $(this).closest('tr');
  var inp = row.find("td:eq(1) input");
  if (inp.val()) {
    row.toggleClass('ustunucizdim');
    if (inp.prop('disabled')) {
      inp.prop('disabled',false);
      console.log("enabled");
    } else {
      inp.prop('disabled',true);
      console.log("disabled");
    }
    $(this).children('i').toggleClass('fa-times-circle fa-undo');
    $(this).toggleClass('btn-danger btn-success');
  } else {
    row.remove();
  }
});

$(document).on('click', '#addtraineerow', function(event) {
  var emptyrow = $(this).closest('tr');

  var icerik = "";
  icerik += "<tr>";
  icerik += "<td>"+$(this).val()+"</td>";
  icerik += '<td><div class="input-group">'
  icerik += '<input type="text" value="" class="traineeInput form-control form-control-sm">'
  icerik += '<div class="input-group-append">'
  icerik += '<span class="deletetrainee input-group-text"><i class="text-danger fas fa-trash"></i></span>'
  icerik += '</div>'
  icerik += '</div></td>';
  icerik += "</tr>";

  emptyrow.before(icerik);
  $('#addtraineerow').val(parseInt($(this).val())+1);
});


$(document).on('change', '#check_approve_list input', function(event) {
  var chlen = $("#check_approve_list input:checked").length;
  if (chlen > 6) {
    $('#btn-saveList').prop('disabled',false);
  } else {
    $('#btn-saveList').prop('disabled',true);
  }
});

$(document).on('click', '#bulkedit', function(event) {
  var textareaicerik = ""
  textareaicerik += '<p>Please edit this trainee list (Copy paste enabled)</p>';
  textareaicerik += '<textarea style="height:150px;" class="form-control" id="trainee_box" name="trainee_box"></textarea>';
  textareaicerik += "<button class='btn  mt-2 btn-info' id='addbulkdata' type='button'>Confirm List</button>";
  var acikolantablo = $(this).closest('table');
  console.log(acikolantablo);
  var taval = "";
  acikolantablo.children('tbody').children('tr').each(function(index, el) {
    var inp = $(this).find("td:eq(1) input");
    var inpval = $(this).find("td:eq(1) input").val();
    if (inpval && !$(this).find("td:eq(1) input").prop('disabled')) {
      taval += inpval+"\n";
    }
  });
  $('#traineeCheckList').html('');
  $('#bulkdata').html(textareaicerik);
  $('#trainee_box').val(taval);
});

$(document).on('click', '#btn-saveList', function(event) {
  var tl = [];
  $('.traineeInput').each(function(index, el) {
    if(!$(this).prop('disabled')) {
      tl.push($(this).val());
    }
  });
  console.log(tl);
  var isimlistesi = JSON.stringify(tl);
  var verivar = nop > 0 ? 1 : 0;
  $.post('clientsportal/approveTraining', {tid: tid, isimlistesi: isimlistesi, verivar: verivar}, function(data, textStatus, xhr) {})
  .done(function(e){
    if (e == '"success"') {
      location.reload();
    }
    console.log("SunucudanGelen Yanıt",e);
  })

});




function createPdf(pagesource) {
    var pdf = new jsPDF('l', 'pt', 'a4');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = pagesource;

    // we support special element handlers. Register them with jQuery-style
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 0,
        bottom: 0,
        left: 0,
        width: pdf.internal.pageSize.width,
        height: pdf.internal.pageSize.height,
        // width: 1190.56,
        // height: 1683.78,
        // right: -300
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    console.log("pdf",pdf.internal.pageSize.width);
    console.log("pdf",pdf.internal.pageSize.height);
    pdf.addHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top,
    { // y coord
        'width': margins.width, // max width of content on PDF
        'height': margins.height, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
      let certfilename = "Sertifika_"+$('#cert-no').text();
        // dispose: object with X, Y of the last line add to the PDF
        //          this allow the insertion of new lines after html
        pdf.save(certfilename);
    }, margins);
}


$(document).on('click', '.viewcert', function(arguments) {
  console.log($(this).data("id"));
  let id = $(this).data("id");
  let tid = $(this).data("tid");
  $('#mdl-traineeList').modal('hide');

  $('#cert-no').html("");
  $('#cert-code').html("");
  $('#cert-name').html("");
  $('#cert-egitmen1').html("");
  $('#cert-egitmen2').html("");


  $.post('clientsportal/getCertificate', {id: id, tid:tid}, function(data, textStatus, xhr) {})
  .done(function(d){
    $('#cert-qrcode').html("");
    console.log("cert_data",d);
    let url = window.location.hostname;
    console.log("url",window.location.hostname);
    $('#cert-no').html(d.cert_no);
    $('#cert-code').html(d.training_code+" - "+d.training_name);
    $('#cert-name').html(d.trainee_name);
    $('#cert-egitmen1').html(d.trainee1);
    $('#cert-egitmen2').html(d.trainee2);

    var qrcode = new QRCode(document.getElementById("cert-qrcode"),{
      text: url+"/checkcert/cert/"+d.qr_code,
      width: 75,
      height: 75
    });
  });

})


$(document).on('click', '#printcertificate', function(arguments) {
  // let isim = $('#cert-name').text()//.toLowerCase();
  // console.log("isim",isim);
  createPdf($('#printArea')[0]);
})


});
