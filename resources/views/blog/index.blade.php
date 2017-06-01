@extends('master')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>AJAX CRUD</h1>
		</div>
	</div>
	 @if(session('alert-success'))
      <div class="alert alert-success">
        {{session('alert-success')}}
      </div>
    @endif
	<div class="row">
		<table class="table table-striped">
			<tr>
				<th>No.</th>
				<th>IMG</th>
				<th>Title</th>
				<th>Desc</th>
				<th>ACTIONS</th>
			</tr>
			<a href="{{route('admin.create')}}" class="btn btn-success pull-right">+</a><br>
			<?php $n = 1; ?>
			@foreach($blogs as $blog)
				<tr>
					<td>{{$n++}}</td>
					<td><img src="img/{{$blog->img}}" alt="" width="30"></td>
					<td>{{$blog->title}}</td>
					<td>{{$blog->desc}}</td>
					<td>
						<form action="{{route('admin.destroy',$blog->id)}}" method="post">
							{{method_field("delete")}}
							{{csrf_field()}}
							<a href="{{route('admin.edit',$blog->id)}}" class="btn btn-primary">EDIT</a>
							<input type="submit" class="btn btn-warning" name="del" value="DELETE" onclick="return confirm('ARE YOU SURE???')">
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
@endsection