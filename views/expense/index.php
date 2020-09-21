<div class="row">
  <div class="col-sm-5">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Income</h3>
          <button id="btn-addIncome" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#mdl-ExpenseIncome">
            Add Income
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table style="width:100%;" class="table table-striped" id="tbl-income">
          <thead>
            <tr>
              <td>#</td>
              <td>Date</td>
              <td>Income</td>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-7">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Expenses</h3>
          <button id="btn-addExpense" type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#mdl-ExpenseIncome">
            Add Expense
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <table style="width:100%;" class="table table-striped" id="tbl-expense">
          <thead>
            <tr>
              <td>#</td>
              <td>Date</td>
              <td>Seller</td>
              <td>Expense</td>
              <td>Remove</td>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>



	<!-- Modal Add Income Expense-->
	<div class="modal fade" id="mdl-ExpenseIncome" tabindex="-1" role="dialog" aria-labelledby="lb-ExpenseIncomeLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="expense/addExpenseIncome" method="post">
					<div class="modal-header">
						<h5 class="modal-title" id="lb-ExpenseIncomeLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="seller">Type:</label>
							<select id="sl-expenseIncomeType" class="custom-select custom-select-lg mb-3" id="type" name="type">
								<option value="income">income</option>
								<option value="expense">expense</option>
							</select>
						</div>
						<div class="form-group">
							<label for="tarih">Date:</label>
							<input type="date" class="form-control" name="tarih" id="tarih">
						</div>
						<div class="form-group">
							<label for="seller">Seller:</label>
							<input type="text" class="form-control" id="seller" name="seller" placeholder="Enter a Seller">
						</div>
						<div class="form-group">
							<label for="miktar">Total:</label>
							<input type="text" class="form-control" id="miktar" name="miktar" placeholder="Enter an Amount">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
						<button type="submit" class="btn btn-info">Kaydet</button>
					</div>
				</form>
			</div>
		</div>
	</div>
  <!-- Modal Add Income Expense END -->
