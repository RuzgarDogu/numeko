console.log("Users table sayfasındayız");


$(document).ready(function() {

  $.post('users/getAllUsers', function(data, textStatus, xhr) {})
  .done(function(d){
    console.log("d",d);
    $('#tbl-userstable').DataTable( {
      "data": d,
      "columns": [
        {"data":"userid"},
        {"data":"login"},
        {"data":"role"}
      ]
    })
  });

});
