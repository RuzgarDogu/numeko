console.log("Trainers sayfasındayız");


$(document).ready(function() {

  var tbl_trainersList;
  var btn_editTrainer = '<button type="button" class="btn-sm btn-editTrainer btn btn-success"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>';

  $.post('trainers/getTrainersList', function(data, textStatus, xhr) {})
  .done(function(d){
    console.log("d",d);
    tbl_trainersList = $('#tbl-trainersList').DataTable( {
      "data": d,
      "columns": [
        {"data":"id"},
        {"data":"trainer_name"},
        {"data":"trainer_type"},
        {"data":"trainer_price"},
        {"data":"trainer_gsm"},
        {"data": function(d){
          let exp = ""
          d.exp.forEach((item, i) => {
            exp += '<small class="p-2 badge badge-info mr-2 text-sm">'+item.training_name+'</small>'
          });
          return exp
        }
      },
      {"data":null},
    ],
    "columnDefs": [
      {
        "targets": -1,
        "defaultContent": btn_editTrainer
      }
    ],
    "dom": 'lrtip'
  })

  $('#inp-globalSearch').keyup(function(){
    tbl_trainersList.search($(this).val()).draw() ;
  })
});


// edit
let trainerData;
$(document).on('click', '.btn-editTrainer', function(event) {
  $('#mdl-editTrainer').modal('show')
  trainerData = tbl_trainersList.row( $(this).closest('tr ') ).data()
});

$('#mdl-editTrainer').on('shown.bs.modal', function(event) {

  console.log("trainerData",trainerData);

  $('#mdl-editTrainerLabel').html(trainerData.trainer_name);
  $('select#trainer_type_edit option').attr('selected', false);

  $('input#trainer_name_edit').val(trainerData.trainer_name);
  $('input#trainer_gsm_edit').val(trainerData.trainer_gsm);
  $('input#trainer_price_edit').val(trainerData.trainer_price);

  $('select#trainer_type_edit option[value="' + trainerData.trainer_type + '"]').attr("selected", true);

  console.log('.trexp_edit',$('.trexp_edit'));

  $('.trexp_edit').each(function(index, el) {
    console.log("trexp_edit",$(this).val());
    let trids = []
    trainerData.exp.forEach((item, i) => {
      trids.push(item.trid)
    });

    if (trids.includes($(this).val())) {
      $(this).prop('checked', true);
    } else {
      $(this).prop('checked', false);
    }
  });

  $('#btn-saveTrainer').on('click', function(evt) {
    evt.preventDefault();
    console.log('butona tıkladım hacı');

    let trainer_type_edit = $('#trainer_type_edit').val();
    let trainer_name_edit = $('#trainer_name_edit').val();
    let trainer_gsm_edit = $('#trainer_gsm_edit').val();
    let trainer_price_edit = $('#trainer_price_edit').val();
    let trexp_edit = [];

    $('.trexp_edit').each(function(index, el) {
      if ($(this).prop('checked')) {
        trexp_edit.push($(this).val());
      }
    });

    console.log(trexp_edit);
    let post_data = {
      id: trainerData.id,
      trainer_type_edit: trainer_type_edit,
      trainer_name_edit: trainer_name_edit,
      trainer_gsm_edit: trainer_gsm_edit,
      trainer_price_edit: trainer_price_edit,
      trexp_edit: trexp_edit,
    }
    console.log(post_data);
    $.post('trainers/saveTrainer', post_data, function(data, textStatus, xhr) {})
    .done(function(e) {
      console.log(e);
      location.reload();
    });

  });




});





});
