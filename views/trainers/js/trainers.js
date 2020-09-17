console.log("Trainers sayfasındayız");


$(document).ready(function() {

  var btn_editTrainer = '<button type="button" class="edit btn btn-success"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>';

  $.post('trainers/getTrainersList', function(data, textStatus, xhr) {})
  .done(function(d){
    console.log("d",d);
    $('#tbl-trainersList').DataTable( {
      "data": d,
      "columns": [
        {"data":"trainer_name"},
        {"data":"trainer_type"},
        {"data":"trainer_price"},
        {"data":"trainer_gsm"},
        // {"data":"trainer_price"},
        {"data":null},
      ],
      "columnDefs": [
        {
          "targets": -1,
          "defaultContent": btn_editTrainer
        }
      ]
    })
  });

});
