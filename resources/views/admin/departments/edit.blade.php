@extends('admin.layout.master')
@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Edit Departments</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.department_update',$department->id)}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="{{$department->title}}">
				</div>
				<!-- <div class="col-sm-3">
					<label>Head Of Department</label>
					<select class="form-control" name="hod">
						<option value="0" {{($department->hod_id == 0) ? "selected" : ""}}>DEFAULT HOD</option>
					</select>
				</div> -->
				<div class="col-sm-3">
					<label>Active</label>
					<select class="form-control" name="active">
						<option value="1" {{($department->active == 1) ? "selected" : ""}}>Active</option>
						<option value="0" {{($department->active == 0) ? "selected" : ""}}>Inactive</option>
					</select>
				</div>
			</div>
			<br>
			<div class=row>
				<div class="col-sm-12">
					<textarea class="form-control" name="description" rows="5">{{$department->description}}</textarea>
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
	</main>
</div>


<!-- <div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit Desigantion</h3>
	</div>
	<div class="box-body">
		
		
	</div>
</div> -->


@endsection