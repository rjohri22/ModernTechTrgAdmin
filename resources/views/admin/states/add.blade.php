@extends('admin.layout.master')
@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Add States</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.states_store')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Name</label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country">
						@foreach ($countries as $country)
						<option value="{{ $country->id }}">{{ $country->name }}</option>

						@endforeach
					</select>
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
	</main>
</div>


<!-- <div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Add State</h3>
	</div>
	<div class="box-body">
		
		
	</div>
</div>
 -->

@endsection