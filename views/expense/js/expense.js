$(document).ready(function() {

  var tbl_expense

  console.log("expense sayfası");

  // INCOME
  $.post('expense/getIncome', function(data, textStatus, xhr) {})
  .done(function(d){
    console.log("d",d);
    tbl_expense = $('#tbl-income').DataTable( {
      "data": d,
      "columns": [
        {"data":"idexp"},
        {"data":"date"},
        {"data": function(d){
          return parseInt(d.total).toLocaleString('tr')
        }
      }
    ],
    "dom": 'rtip'
  })
});

// EXPENSE
var btn_editExpense = '<button type="button" class="btn-sm btn-deleteExpense btn btn-default"><i class="text-danger far fa-trash-alt" aria-hidden="true"></i></button>';
$.post('expense/getExpense', function(data, textStatus, xhr) {})
.done(function(d){
  console.log("d",d);
  tbl_expense = $('#tbl-expense').DataTable( {
    "data": d,
    "columns": [
      {"data":"idexp"},
      {"data":"date"},
      {"data":"seller"},
      {"data": function(d){
        return parseInt(d.total).toLocaleString('tr')
      }
    },
    {"data":null},
  ],
  "columnDefs": [
    {
      "targets": -1,
      "defaultContent": btn_editExpense
    }
  ],
  "dom": 'rtip'
})
});

$('#inp-globalSearch').keyup(function(){
  tbl_expense.search($(this).val()).draw() ;
})

$('#btn-addIncome').on('click', (arguments) => {
  $('#lb-ExpenseIncomeLabel').html("Add Income")
  $('#sl-expenseIncomeType').val("income").addClass('bg-success');
})

$('#btn-addExpense').on('click', (arguments) => {
  $('#lb-ExpenseIncomeLabel').html("Add Expense")
  $('#sl-expenseIncomeType').val("expense").addClass('bg-danger');
})

// $(document).on('click', '.btn-deleteExpense', function(e) {
//   expenseData = tbl_expense.row( $(this).closest('tr ') ).data()
//   let id = expenseData.idexp;
//   if (confirm(expenseData.date+" tarihinde "expenseData.seller+"için ödenen "+expenseData.total+" ₺ tutarındaki kaydı silmek istediğinizden emin misiniz?")) {
//     console.log("silindi");
//   }
// });

$(document).on('click', '.btn-deleteExpense', function(e) {
  expenseData = tbl_expense.row( $(this).closest('tr ') ).data()
  let id = expenseData.idexp;
  let mesaj = expenseData.date+" tarihinde "+expenseData.seller+" için ödenen "+expenseData.total+" ₺ tutarındaki kaydı silmek istediğinizden emin misiniz?"
  console.log(mesaj);
  if (confirm(mesaj)) {
    $.post('expense/deleteExpense', { id: id }, function(data, textStatus, xhr) {})
    .done(function(d){
      if (d=='"success"') {
        console.log(d);
        window.location.reload();
      }
    });
  }
});

});
