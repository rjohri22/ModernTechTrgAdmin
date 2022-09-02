@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit State</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.states_update',$state->id)}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Name</label>
					<input type="text" name="name" class="form-control" value="{{$state->name}}" >
				</div>
				<div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country">
						@foreach ($countries as $country)
						<option value="{{ $country->id }}" @if ($country->id == $state->country_id) selected @endif >{{ $country->name }}</option>

						@endforeach
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Status</label>
					<select class="form-control" name="statue">
						<option value="1" @if ($state->status == 1) selected @endif >Active</option>
						<option value="0" @if ($state->status == 0) selected @endif >Inactive</option>
					</select>
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