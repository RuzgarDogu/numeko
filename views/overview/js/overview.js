console.log("Overview sayfası");

$(document).ready(function() {
  var calendarEl = document.getElementById('calendar');
  console.log(calendarEl);
  var calendar = new FullCalendar.Calendar(calendarEl, {
    eventSources: [
      // your event source
      {
        url: 'overview/getCalendar',
        method: 'POST',
        failure: function() {
          alert('Eğitimleri almaya çalışırken bir hata oluştu. Sayfayı yenileyin!');
        },
        success: function(data){
          console.log(data);
        },
        color: '#e67c73',   // a non-ajax option
        borderColor: '#e67c73',
        textColor: 'white', // a non-ajax option
      }

    ],
  });

  calendar.render();


  calendar.on('eventClick', function(info) {
    let eid = info.event.id;
    console.log(eid);
    $.post('overview/getEventDetails', {id:eid}, function(data, textStatus, xhr) {})
    .done(function(d){
      data = d[0]
      if (data.status == "0") {
        data.status = 'Onay Bekleyen'
      } else if (data.status == "1") {
        data.status = 'Planlanmış'
      } else if (data.status == "2") {
        data.status = 'Gerçekleşen'
      } else {
        data.status = "-"
      }
      console.log(data);
      $('#eventDetailModal').modal('show');
      $('#eventDetailModal').on('shown.bs.modal', function(event) {
        console.log(data);
        let edb = ""

        edb += '<table class="table table-striped text-sm">'
        edb += '<tr>'
        edb += '<td><strong class="text-info">Client Name:</strong></td>'
        edb += '<td>'+data.client_name+'</td>'
        edb += '</tr>'
        edb += '<tr>'
        edb += '<td><strong class="text-info">City:</strong></td>'
        edb += '<td>'+data.city+'</td>'
        edb += '</tr>'
        edb += '<tr>'
        edb += '<td><strong class="text-info">Status:</strong></td>'
        edb += '<td>'+data.status+'</td>'
        edb += '</tr>'
        edb += '<tr>'
        edb += '<td><strong class="text-info">Training Name:</strong></td>'
        edb += '<td>'+data.training_name+'</td>'
        edb += '</tr>'
        edb += '<tr>'
        edb += '<td><strong class="text-info">Training Date</strong></td>'
        edb += '<td>'+data.training_date+'</td>'
        edb += '</tr>'
        edb += '<tr>'
        edb += '<td><strong class="text-info">Trainer Name:</strong></td>'
        edb += '<td>'+data.trainer_name+'</td>'
        edb += '</tr>'
        edb += '</table>'

        $('#eventDetailsBody').html(edb);
        $('#mdl-calendarInfoLabel').text(data.client_name)
      });
      $('#eventDetailModal').on('hidden.bs.modal', function () {
        $('#eventDetailsBody').html('');
      })
    });
  });

  $.post('overview/getTrainerTraineCount', function(data, textStatus, xhr) {})
  .done(function(e){
    console.log(e);
    var metin = 'Eğitmenlere Göre Öğrenci Sayıları';
    var cont = 'gra1';
    getPieData(e, cont, metin);
  });

  $.post('overview/getTraineeByDate', function(data, textStatus, xhr) {})
  .done(function(e){
    console.log(e);
    getLineData(e,'gra2');
  });

  $.post('overview/getTraineesByClients', function(data, textStatus, xhr) {})
  .done(function(e){
    var veri = e
    var dat = new Array();
    var cat = new Array();
    veri.forEach( function(element, index) {
      cat.push(element.cn);
      dat.push(element.cnt);
    });
    var cont = 'gra3';
    getBarData(dat,cat,cont);
  });

  $.post('overview/getTraineesByTrainings', function(data, textStatus, xhr) {})
  .done(function(e){
    var cont = 'gra4';
    var metin = 'Eğitim Türüne Göre Trainee Sayıları'
    getPieData(e, cont, metin);
  });

});
