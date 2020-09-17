$(document).ready(function() {
  console.log("Main js sayfası");

  $(document).on('click', '#user-logout', (arguments) => {
    if (confirm("Çıkış yapmak istediğinize emin misiniz?")) {
      return true;
    }
    return false;
  })

});
