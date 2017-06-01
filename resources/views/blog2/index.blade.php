@extends('master2')

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<h1>SIMPLE LARAVEL CRUD</h1>
		</div>
	</div>
	<div class="form-group row add">
			<div class="col-md-5">
				<input type="text" class="form-control" id="title" name="title" placeholder="TITLE" required>
			<p class="error text-center alert alert-denger hidden"></p>
		</div>
	<div class="col-md-5">
				<input type="text" class="form-control" id="description" name="description" placeholder="DESCRIPTION" required>
			<p class="error text-center alert alert-denger hidden"></p>
		</div>	
		<div class="col-md-2">
			<button class="btn btn-warning" type="button" id="add">
				<span class="glyphicon glyphicon-plus"></span>ADD
			</button>
		</div>
	</div>
	<div class="row">
		<div class="table-responsive">
			<table class="table table-borderless" id="table">
				<tr>
				<th>No.</th>
				<th>Title</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
				{{csrf_field()}}
			<?php $n=1 ?>
			@foreach($blogs as $blog)
				<tr class="Item{{$blog->id}}">
				<td>{{$n++}}</td>
				<td>{{$blog->title}}</td>
				<td>{{$blog->desc}}</td>
				<td>
					<button class="edit-modal btn btn-primary" data-id="{{$blog->id}}" data-title="{{$blog->title}}" data-description="{{$blog->desc}}">
						<span class="glyphicon glyphicon-edit"></span>EDIT
					</button>
					<button class="delete-modal btn btn-danger" data-id="{{$blog->id}}" data-title="{{$blog->title}}" data-description="{{$blog->desc}}">
						<span class="glyphicon glyphicon-trash"></span>DELETE
					</button>	
				</td>
			</tr>
			@endforeach

			</table>
		</div>
	</div>
	<div id="myModal" class="modal fade" role='dialog'>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form action="" class="form-horizontal" role='form'>
						<div class="form-group">
							<label for="id" class="control-label col-sm-2">ID:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="fid" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="control-label col-sm-2">TITLE:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="t">
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="control-label col-sm-2">DESCRIPTION:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="d">
							</div>
						</div>	
					</form>
					<div class="deleteContent">
						ARE YOU SURE<span class="title"></span>?
						<span class="hidden id"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class="glyphicon"></span>
						</button>
						<button type="button" class="btn warning" data-dismiss="modal">
							<span class="glyphicon glyphicon-remove"></span>CLOSE
						</button>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	


@endsection