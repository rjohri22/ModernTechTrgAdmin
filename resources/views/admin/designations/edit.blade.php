@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit Desigantion</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.designation_update',$designation->id)}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="{{$designation->title}}">
				</div>
				<div class="col-sm-3">
					<label>Active</label>
					<select class="form-control" name="active">
						<option value="1" {{($designation->active == 1) ? "selected" : ""}}>Active</option>
						<option value="0" {{($designation->active == 0) ? "selected" : ""}}>Inactive</option>
					</select>
				</div>
			</div>
			<br>
			<div class=row>
				<div class="col-sm-12">
					<textarea class="form-control" name="description" rows="5">{{$designation->description}}</textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" type="submit" style="float: right">Save</button>
				</div>
			</div>
			<br>
		</form>
	</div>
</div>


@endsection