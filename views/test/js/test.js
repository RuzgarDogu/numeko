console.log("Test sayfasındayız");
$.post('test/deneme', function(data, textStatus, xhr) {})
.done(function(d){
  console.log(JSON.parse(d));
});
