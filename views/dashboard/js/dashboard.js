$(document).ready(function() {
  console.log("Dashboard js sayfası");


  function createPdf(pagesource) {
      var pdf = new jsPDF('l', 'pt', 'a4');
      // source can be HTML-formatted string, or a reference
      // to an actual DOM element from which the text will be scraped.
      source = pagesource;

      // we support special element handlers. Register them with jQuery-style
      // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
      // There is no support for any other type of selectors
      // (class, of compound) at this time.
      specialElementHandlers = {
          // element with id of "bypass" - jQuery style selector
          '#bypassme': function (element, renderer) {
              // true = "handled elsewhere, bypass text extraction"
              return true
          }
      };
      margins = {
          top: 0,
          bottom: 0,
          left: 0,
          width: pdf.internal.pageSize.width,
          height: pdf.internal.pageSize.height,
          // width: 1190.56,
          // height: 1683.78,
          // right: -300
      };
      // all coords and widths are in jsPDF instance's declared units
      // 'inches' in this case
      console.log("pdf",pdf.internal.pageSize.width);
      console.log("pdf",pdf.internal.pageSize.height);
      pdf.addHTML(
      source, // HTML string or DOM elem ref.
      margins.left, // x coord
      margins.top,
      { // y coord
          'width': margins.width, // max width of content on PDF
          'height': margins.height, // max width of content on PDF
          'elementHandlers': specialElementHandlers
      },

      function (dispose) {
          // dispose: object with X, Y of the last line add to the PDF
          //          this allow the insertion of new lines after html
          pdf.save('Test.pdf');
      }, margins);
  }

$.post('dashboard/test', {param1: 'Deneme Metni'}, function(data, textStatus, xhr) {})
.done(function(e){
  console.log("------");
  console.log($(e));
  let eleman = $(e)[0];
  // console.log(document.querySelector("#capture"));
  console.log("------");
  // html2canvas(eleman).then(canvas => {
  //   document.body.appendChild(canvas)
  // });
  // var pdf = new jsPDF('p', 'pt', 'letter');
  // pdf.addHTML($('#kart')[0], function () {
  //     pdf.save('Test.pdf');
  // });
  $('#appendable').append(eleman);

$(document).on('click', '#printcertificate', function(arguments) {
  createPdf(eleman);
})

});

  // var doc = new jsPDF();
  // var elementHTML = $('#kart').html();
  // var specialElementHandlers = {
  //     '#elementH': function (element, renderer) {
  //         return true;
  //     }
  // };
  // doc.fromHTML(elementHTML, 15, 15, {
  //     'width': 170,
  //     'elementHandlers': specialElementHandlers
  // });
  //
  // // Save the PDF
  // doc.save('sample-document.pdf');


  // const doc = new jsPDF({
  //   orientation: "landscape",
  //   unit: "in",
  //   format: [4, 2],
  //   source : $('#kart')[0]
  // });
  // console.log("doc",doc);
  // // doc.text($('#kart'), 10, 10);
  // doc.save("a4.pdf");


});
