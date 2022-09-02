@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Add Country</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.countries_store')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Name</label>
					<input type="text" name="name" class="form-control">
				</div>
				
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Status</label>
					<select class="form-control" name="statue">
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" type="submit">Save</button>
				</div>
			</div>
			<br>
		</form>
	</div>
</div>


@endsection