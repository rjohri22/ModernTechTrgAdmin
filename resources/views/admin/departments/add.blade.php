@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Add Department</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.department_store')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<label>Title</label>
					<input type="text" name="title" class="form-control">
				</div>

				<div class="col-sm-3">
					<label>Head Of Department</label>
					<select class="form-control" name="hod">
						<option value="0">DEFAULT HOD</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label>Active</label>
					<select class="form-control" name="active">
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</div>
			</div>
			<br>
			<div class=row>
				<div class="col-sm-12">
					<label>Description</label>
					<textarea class="form-control" name="description" rows="5"></textarea>
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