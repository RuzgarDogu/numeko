$(document).ready(function() {


      $('#sl-clients').on('change', function(event) {
      	console.log($(this).val());
      	if ($(this).val() == 3) {
      		let kutucuk = '<input type="text" class="form-control" name="yeni_client" id="kutu_type" placeholder="Enter New">';
      		$('#kutucuklu').append(kutucuk);
      		$(this).attr('name', 'clients');
      	} else {
      		$('#kutu_type').remove();
      		$(this).attr('name', 'clients');
      	}
      });

      var tab1_table;
      var tab2_table;
      var tab3_table;
      var btn_editTraining = '<button type="button" class="btn-sm btn-trainingedit btn btn-default" data-toggle="modal" data-target="#trainingEditModal"><i class="text-danger fas fa-edit" aria-hidden="true"></i></button>';

      // Tablo 1
      $.post('logbook/getTab1', function(data, textStatus, xhr) {})
      .done(function(d){
        console.log("d",d);
        tab1_table = $('#tab1_table').DataTable( {
          "data": d,
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
            {"data":null}
        ],
        "columnDefs": [
          {
            "targets": -1,
            "defaultContent": btn_editTraining
          }
        ],
        "dom": 'lrtip',
        "order": [[ 2, "desc" ]]
      })
    });
    // Tablo 1 End

    // Tablo 2
    $.post('logbook/getTab2', function(data, textStatus, xhr) {})
    .done(function(d){
      console.log("d",d);
      tab2_table = $('#tab2_table').DataTable( {
        "data": d,
        "columns": [
          {"data":"trid"},
          {"data":"training_date"},
          {"data":"training_name"},
          {"data":"client_name"},
          {"data":"trainee_id"},
          {"data":"trainee_name"},
          {"data":"cert_no"},
          {"data":"trainer_name"}
      ],
      "dom": 'lrtip'
    })
  });
  // Tablo 2 End


  // Tablo 3
  $.post('logbook/getTab3', function(data, textStatus, xhr) {})
  .done(function(d){
    console.log("d",d);
    tab3_table = $('#tab3_table').DataTable( {
      "data": d,
      "columns": [
        {"data":"id"},
        {"data":"training_date"},
        {"data":"training_code"},
        {"data":"training_name"},
        {"data":"client_name"},
        {"data":"trainee_id"},
        {"data":"trainee_name"},
        {"data":"cert_no"},
        {"data":"validuntil"},
        {"data":"city"},
        {"data":"trainer_name"},
        {"data":"TRN2"},
        {"data":"duration"}
    ],
    "dom": 'lrtip'
  })
});
// Tablo 3 End


    $('#inp-globalSearch').keyup(function(){
      console.log($("ul#tb-logbook-tab li a.active").attr("id"));
      let activeTab = $("ul#tb-logbook-tab li a.active").attr("id");
      if (activeTab == "tb-logbook-trainingList-tab") {
        tab1_table.search($(this).val()).draw();
      } else if (activeTab == "tb-logbook-logbook-tab") {
        tab2_table.search($(this).val()).draw();
      } else if (activeTab == "tb-logbook-logdata-tab") {
        tab3_table.search($(this).val()).draw();
      } else {
        tab1_table.search($(this).val()).draw();
      }
    })


    $('#tb-logbook-tab li a').on('click', function(e) {
      console.log($(this).attr("id"));
      let activeTab = $(this).attr("id");
      if (activeTab == "tb-logbook-trainingList-tab") {
        $('#li-tab1Filter').css("display","block");
        $('#li-tab1Filter select').val("Tümünü Göster");
      } else if (activeTab == "tb-logbook-logbook-tab") {
        $('#li-tab1Filter').css("display","none");
        $('#li-tab1Filter select').val("Tümünü Göster");
      } else if (activeTab == "tb-logbook-logdata-tab") {
        $('#li-tab1Filter').css("display","none");
        $('#li-tab1Filter select').val("Tümünü Göster");
      }
    })

    $("ul#tb-logbook-tab li a").on('click', (arguments) => {
      $('#inp-globalSearch').val("");
      tab1_table.search('').draw() ;
    })

    $(document).on('change','#filtreleme_1',function(){
        var selectedValue = $(this).val();
        if ($(this).val() == "Tümünü Göster") {
            tab1_table.search("").draw();
        } else {
          tab1_table.search(selectedValue).draw();
        }
    });

});
