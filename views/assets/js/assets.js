$(document).ready(function() {


  var tbl_assetsList
  var btn_deleteAsset = '<button type="button" class="btn-sm btn-deleteAsset btn btn-default"><i class="text-danger far fa-trash-alt" aria-hidden="true"></i></button>';
  var btn_addMaint = '<button type="button" class="btn-sm btn-addMaint btn btn-default" data-toggle="modal" data-target="#mdl-addMaint"><i class="text-success fas fa-plus" aria-hidden="true"></i></button>';


  $.post('assets/getAssetList', function(data, textStatus, xhr) {})
  .done(function(d){
    console.log("d",d);
    tbl_assetsList = $('#tbl-assetsList').DataTable( {
      "data": d,
      "columns": [
        {"data":"id"},
        {"data":"type_name"},
        {"data":"brand"},
        {"data":"model"},
        {"data":"serino"},
        {"data": function(d){
          if (d.maint_name) {
            return '<button type="button" class="btn btn-sm btn-info" data-trigger="focus" data-toggle="popover" title="Bakımı Yapan" data-content="'+d.maint_name+'">'+d.maint_valid+'<i class="ml-2 fas fa-chevron-right"></i></button>'
          } else {
            return '<small class="badge badge-warning p-2">Bakım kaydı yok</small>'
          }
        }
      },
      {"data":null},
      {"data":null}
    ],
    "columnDefs": [
      {
        "targets": -1,
        "defaultContent": btn_addMaint
      },
      {
        "targets": -2,
        "defaultContent": btn_deleteAsset
      }
    ],
    "dom": 'lrtip',
    "initComplete": function(settings, json) {
      $(function () {
        $('[data-toggle="popover"]').popover();
      })
    }
  })

  $('#inp-globalSearch').keyup(function(){
    tbl_assetsList.search($(this).val()).draw() ;
  })

});

  $(document).on('click', '.btn-deleteAsset', function(event) {
    asseetData = tbl_assetsList.row( $(this).closest('tr ') ).data()
    console.log(asseetData);
    let id = asseetData.id;
    let mesaj = asseetData.brand+" markasına ait "+asseetData.model+" model ve seri numarası "+asseetData.serino+" olan kaydı silmek istediğinizden emin misiniz?"
    console.log(mesaj);
    if (confirm(mesaj)) {
      console.log("ok");
      $.post('assets/deleteAsset', { id: id }, function(data, textStatus, xhr) {})
      .done(function(d){
        console.log(d);
        if (d=='"success"') {
          console.log(d);
          window.location.reload();
        }
      });
    }
  });

  $(document).on('click', '.btn-addMaint', function(event) {
      var thisid = tbl_assetsList.row( $(this).closest('tr ') ).data().id;
      $('#h_assetid').val(thisid);
  });

  $('#sl-type').on('change', function(event) {
    console.log($(this).val());
    if ($(this).val() == 3) {
      let kutucuk = '<input type="text" class="form-control" name="yeni_type" id="kutu_type" placeholder="Enter New">';
      $('#kutucuklu').append(kutucuk);
      $(this).attr('name', 'type');
    } else {
      $('#kutu_type').remove();
      $(this).attr('name', 'type');
    }
  });

});
