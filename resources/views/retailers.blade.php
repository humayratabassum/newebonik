<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>wecome to our ebonik site</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"
	rel="stylesheet">
</head>
<body>
	
	<div class="container">
		<h1>Retailer</h1>
		<a class="btn btn-success" href="javascript:void(0)" id="newretailer"style ="float:right">ADD</a>
		<table class="table table-bordered data-table">
			<thead>
				<tr>
					<th>no</th>
					<th>shop_name</th>
					<th>proprietor_name</th>
					<th>shop_area</th>
					<th>shop_type</th>
					<th>contact_no</th>
					<th>shop_no</th>
					<th>action</th>
				</tr>
			</thead>
			<tbody></tbody>
			
		</table>
	</div>
	<div class ="model fade" id="ajaxModel" aria-hidden="true">
		<div class="model-content">
		<div class ="modal-header">
		<h4 class ="model-title" id ="modalHeading"></h4>
		</div>
		<div class="model-body">
			<form id="retailerform" name="retailerform"  class="from-horizontal">
				<input type="hidden" name="retailer_name" id="retailer_id">
				<div class="from-group">
				shop_name:<br>
				<input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="Enter" value="" required>
			</div>
				<div class="from-group">
				proprietor_name:<br>
				<input type="text" class="form-control" id="proprietor_name" name="proprietor_name" placeholder="Enter" value="" required>
			</div>

				<div class="from-group">
				shop_area:<br>
				<input type="text" class="form-control" id="shop_area" name="shop_area" placeholder="Enter" value="" required>
			</div>

				<div class="from-group">
				shop_type<input type="text" class="form-control" id="shop_type" name="shop_type" placeholder="Enter" value="" required>
			</div>

				<div class="from-group">
				contact_no:<br>
				<input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter" value="" required>
			</div>

				<div class="from-group">
				shop_no:<br>
				<input type="text" class="form-control" id="shop_no" name="shop_no" placeholder="Enter" value="" required>

			</div>
			<button type="submit" class="btn btn-primary" id="saveBtn" value="create">save</button>
		</form>
	</div>
			
		</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


</body>
<script type="text/javascript">
	$(function(){
		$.ajaxSetup({
			heafers:{
				'X-CSRF':$('meta[name="csrf-token"]').attr('content')
			}
		});
 var table= $(".data-table").DataTable({
		serverSide:true,
		processing:true,
		ajax:"{{route('retailers.index')}}",
		columns:[
		
			{data:'DT_RowIndex',name:'DT_RowIndex'},
			{data:'shop_name',name:'shop_name'},
			{data:'proprietor_name',name:'proprietor_name'},
			{data:'shop_area',name:'shop_area'},
			{data:'shop_type',name:'shop_type'},
			{data:'contact_no',name:'contact_no'},
			{data:'shop_no',name:'shop_no'},
			{data:'action',name:'action'},
			

			]
	});
    $(("#createretailer").click(function(){
    	$('#retailer_id').val();
    	$("#retailerfrom").trigger("reset");
    	$("#modalHeading").html("Add retailer");
    	$('#ajaxModel').modal('show');

    });
    $("#saveBtn").click(function(e){
    	e.preventDefault();
    	$(this).html('save');
    	$.ajax({
    		data:$("#retailerform").serialize();
    		url:"{{route('retailers.store')}}",
    		type:"POST",dataTypes:'json',success:function(data){
    			$("#retailerfrom").trigger("reset");
    			$('#ajaxModel').modal('hide');
    			table.draw();



    		},
    		error:function(data){
    			console.log('Error',data);
    			$("#saveBtn").html('save');
    		}

    	});

    });


    $('body').on('click','.deleteretailer',function(){
    	var retailer_id =$(this).data("id");
    	confirm("are you delete data");
    	$.ajax({
    		type:"delete",
    		url:"{{route('retailers.store')}}"+ '/'+ retailer_id,
    		success:function(data){
    			table.draw();
    		},
    		error:function(data){
    			console.log('Error',data);
    		}
    	});
    	

    });
     $('body').on('click','.editretailer',function(){
    	var retailer_id =$(this).data("id");
    	$.get("{{('retailers.index')}}"+"/"+retailer_id+"/edit",function(data){
    		$("modalHeading").html("edit retailer");
    		$('#ajaxModel').model('show');
    		$('#retailer_id').val(data.id);
    		$('#shop_name').val(data.id);
    		$('#proprietor_name').val(data.id);
    		$('#shop_area').val(data.id);
    		$('#shop_type').val(data.id);
    		$('#contact_no').val(data.id);
    		$('#shop_no').val(data.id);
    	});


	});
	
	
</script>
</html>