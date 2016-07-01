<!DOCTYPE html>
<html>
	<head>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
		<script src="https://code.jquery.com/jquery-1.12.3.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<h1 style="font-size:20pt">Ajax CRUD with Bootstrap modals and Datatables</h1>
	<h3>Data Product</h3>
	<br>
	<br>
	<button class="btn btn-success" onclick="add_product()"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
	<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
	<br>
	<br>
	<body>
		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>id</th>
					<th>name</th>
					<th>price</th>
					<th>description</th>
					<th>stock</th>
					<th>size</th>
					<th>action </th>
				</tr>
			</thead>			
		</table>

		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Product</h4>
					</div>
					<div class="modal-body">
						<p></p>
						<form action="<?php echo base_url() ?>product_update_data" method="GET" id="form" class="form-horizontal">
							<div class="form-body">
								<div class="form-group">
									<label class="control-label col-md-3">Name</label>
									<div class="col-md-9">
										<input id="name" name="name" placeholder="name" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Price</label>
									<div class="col-md-9">
										<input id="price" name="price" placeholder="price" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Description</label>
									<div class="col-md-9">
										<input id="description" name="description" placeholder="description" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Stock</label>
									<div class="col-md-9">
										<input id="stock" name="size" placeholder="size" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Size</label>
									<div class="col-md-9">
										<input id="size" name="size" placeholder="size" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<input id="id" name="id"  type="hidden">
							</div>
							<div class="modal-footer">
								<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							</div>
						</form>

					</div>

				</div>

			</div>
		</div>

		<!-- Modal_delete -->
		<div class="modal fade" id="deleteModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Anda Yakin akan menghapus data ini?</h4>
					</div>
					<div class="modal-body">
						<input id="id_delete" name="id"  type="hidden">
							<button type="button" id="btnOk" onclick="ok_delete_person()"class="btn btn-primary">Ok</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Add -->
		<div class="modal fade" id="addModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add Product</h4>
					</div>
					<div class="modal-body">
						<p></p>
						<form action="<?php echo base_url() ?>product_add_data" method="POST" id="form" class="form-horizontal">
							<div class="form-body">
								<div class="form-group">
									<label class="control-label col-md-3">Name</label>
									<div class="col-md-9">
										<input id="name_add" name="name" placeholder="name" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Price</label>
									<div class="col-md-9">
										<input id="price_add" name="price" placeholder="price" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Description</label>
									<div class="col-md-9">
										<input id="description_add" name="description" placeholder="description" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Stock</label>
									<div class="col-md-9">
										<input id="stock_add" name="size" placeholder="size" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Size</label>
									<div class="col-md-9">
										<input id="size_add" name="size" placeholder="size" class="form-control" type="text">
										<span class="help-block"></span>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" id="btnSave" onclick="save_add_product()" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							</div>
						</form>

					</div>

				</div>

			</div>
		</div>

		<script>
						var table;
						$(document).ready(function() {
							table = $('#example').DataTable({
								"processing": true,
								"serverSide": true,
								"ajax": {
									"url": "<?php echo base_url() ?>product_list",
									"type": "GET"
								},
								"columns": [
									{"data": "id"},
									{"data": "name"},
									{"data": "price"},
									{"data": "description"},
									{"data": "stock"},
									{"data": "size"},
									{"data": "action"}
								],
								"draw": 1
							});
						});
						function edit_person(id)
						{
							name = '';
							price = '';
							description = '';
							stock = '';
							size = '';
							$.ajax({
								url: "<?php echo base_url() ?>product_get_data",
								type: "GET",
								data: "id=" + id,
								success: function(result) {
									obj = JSON.parse(result);
									name = obj.name;
									price = obj.price;
									description = obj.description;
									stock = obj.stock;
									size = obj.size;
									$('#name').val(name);
									$('#price').val(price);
									$('#description').val(description);
									$('#stock').val(stock);
									$('#size').val(size);
									$('#id').val(id);
								}
							});
							$('#myModal').modal('show');
						}
						function delete_person(id)
						{
							$('#id_delete').val(id);
							$('#deleteModal').modal('show');
						}

						function ok_delete_person()
						{
							id=$('#id_delete').val();
							$.ajax({
								url: "<?php echo base_url() ?>product_delete_data",
								type: "GET",
								data: "id=" + id,
								success: function(result) {
									$('#deleteModal').modal('hide');
									table.ajax.reload();
								}
							});
						}

						function save()
						{
							id = $('#id').val();
							name = $('#name').val();
							price = $('#price').val();
							description = $('#description').val();
							stock = $('#stock').val();
							size = $('#size').val();
							$.ajax({
								url: "<?php echo base_url() ?>product_update_data",
								type: "GET",
								data: "id=" + id + "&name=" + name + "&price=" + price + "&description=" + description + "&stock=" + stock + "&size=" + size,
								success: function(result) {
									$('#myModal').modal('hide');
									table.ajax.reload();
								}
							});
						}
						
						function add_product()
						{
							$('#addModal').modal('show');
						}
						
						function save_add_product()
						{							
							name_add = $('#name_add').val();
							price_add = $('#price_add').val();
							description_add = $('#description_add').val();
							stock_add = $('#stock_add').val();
							size_add = $('#size_add').val();
							$.ajax({
								url: "<?php echo base_url() ?>product_add_data",
								type: "POST",
								data: "name=" + name_add + "&price=" + price_add + "&description=" + description_add + "&stock=" + stock_add + "&size=" + size_add,
								success: function(result) {
									$('#addModal').modal('hide');
									table.ajax.reload();
								}
							});

						}
						
						function reload_table()
						{
							table.ajax.reload();
						}
						
		</script>
	</body>
</html>