@extends('master')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>EDIT CRUD</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('admin.update',$blog->id)}}" method="post" enctype="multipart/form-data">
				{{method_field('PATCH')}}
				{{csrf_field()}}

				<div class="form-group {{($errors->has('img'))?$errors->first('img'):""}}">
					<img width="100px" src="/img/{{$blog->img}}" alt="">
					<input type="hidden" name="oimg" value="{{$blog->img}}">
					<input type="file" name="img" class="form-control">
					{!! $errors->first('img','<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group {{($errors->has('title'))?$errors->first('title'):""}}">
					<input type="text" name="title" class="form-control" placeholder="Enter title" value="{{$blog->title}}">
					{!! $errors->first('title','<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group {{($errors->has('desc'))?$errors->first('desc'):""}}">
					<input type="text" name="desc" class="form-control" placeholder="Enter desc" value="{{$blog->desc}}">
					{!! $errors->first('desc','<p class="help-block">:message</p>') !!}
				</div> 
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="save">
				</div>
			</form>
		</div>
	</div>
@endsection