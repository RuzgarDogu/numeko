$(document).ready(function() {
  console.log("Main js sayfası");

  $(document).on('click', '#user-logout', (arguments) => {
    if (confirm("Çıkış yapmak istediğinize emin misiniz?")) {
      return true;
    }
    return false;
  })

  const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);
  if (!isInStandaloneMode()) {
    $('#btnAdd').prop('disabled', true);
    $('#btnAdd').html('Uygulama Yüklendi');
  }


});
