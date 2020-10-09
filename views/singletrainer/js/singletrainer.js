console.log("Single Trainer sayfasındayız");


$(document).ready(function() {

var btn_editTraining = '<button type="button" class="btn-sm btn-trainingview btn btn-default" data-toggle="modal" data-target="#mdl-viewTraining"><i class="text-danger fas fa-eye" aria-hidden="true"></i></button>';
var btn_confirmTraining = '<button type="button" class="btn-sm btn-trainingconfirm btn btn-default"><i class="text-success fas fa-check" aria-hidden="true"></i></button>';

  $.post('logbook/getTab1', function(data, textStatus, xhr) {})
  .done(function(d){
    console.log("d",d);
    tab1_table = $('#tbl-trainingLog').DataTable( {
      "data": d,
      "order": [[ 0, "desc" ]],
      "columns": [
        {
          "data": function(d){
            var cellicerik = "";
            if (d.status == -1) {
              cellicerik = '<small class="badge badge-danger p-2">İptal</small>';
            } else if (d.status == 0) {
              cellicerik = '<small class="badge badge-info p-2">Planlanan</small>';
            } else if (d.status == 1) {
              cellicerik = '<small class="badge badge-success p-2">Onaylanan</small>';
            } else if (d.status == 2) {
              cellicerik = '<small class="badge badge-secondary p-2">Gerçekleşen</small>';
            }
            return cellicerik
          }
        },
        {"data":"training_date"},
        {"data":"id"},
        {"data":"training_name"},
        {"data":"client_name"},
        {"data":"participants"},
        {"data":"validuntil"},
        {"data":"city"},
        {"data":"trainer_name"},
        {
           "sortable": false,
           "render": function ( data, type, row, meta ) {
               console.log("data",row);
               let butonlar = btn_editTraining;
               if (row.status == 2) {
                 butonlar += btn_confirmTraining
               }
               return butonlar;
           }
         },
    ],
    // "columnDefs": [
    //   {
    //     "targets": -1,
    //     "defaultContent": function(d) {
    //       return btn_editTraining+btn_confirmTraining
    //     }
    //   }
    // ],
    "dom": 'lrtip',
    "order": [[ 2, "desc" ]]
  })
});



});
