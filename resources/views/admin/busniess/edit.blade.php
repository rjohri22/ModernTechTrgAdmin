@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit Business</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.busniess_update',$busniess->id)}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="{{$busniess->name}}" >
				</div>
				<!-- <div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country" id="country">
						@foreach ($countries as $country)
						<option value="{{ $country->id }}" @if ($country->id == $busniess->country) selected @endif >{{ $country->name }}</option>
						@endforeach
					</select>
				</div> -->
				<!-- <div class="col-sm-4">
					<label>State</label>
					<select class="form-control" name="state" id="state">
					</select>
				</div> -->
				<!-- <div class="col-sm-4">
					<label>City</label>
					<select class="form-control" name="city" id="cities" >
					</select>
				</div> -->
				<div class="col-sm-4">
					<label>Address</label>
					<input type="text" name="address" class="form-control" value="{{$busniess->address}}" >
				</div>
				<div class="col-sm-4">
					<label>Active</label>
					<select class="form-control" name="status">
						<option value="1" @if ($busniess->status == 1) selected @endif >Active</option>
						<option value="0" @if ($busniess->status == 0) selected @endif >Inactive</option>
					</select>
				</div>
			</div>
			<br>
			<div class=row>
				<div class="col-sm-12">
					<label>Description</label>
					<textarea class="form-control" name="description" rows="5">{{$busniess->description}}</textarea>
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
@section('footer')
<script>
	$(document).ready(function(){
		$('#country').change(function(){
			console.log('change country');
			loadstate();
		});
		loadstate();
		function loadstate(){
			console.log('Load States');
			var id = $('#country').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.cities_states')}}",
				type: 'POST',
				data: {id:id},
				success: function(data) {
					$('#state').html(data.html);
					$('#state').val({{$busniess->state}});
					loadcity();
				}
			});

		}
		$('#state').change(function(){
			console.log('change state');
			loadcity();
		});
		loadcity();
		function loadcity(){
			console.log('Load City');
			var id = $('#state').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.cities_list')}}",
				type: 'POST',
				data: {id:id},
				success: function(data) {
					$('#cities').html(data.html);
					$('#cities').val({{$busniess->city}});
				}
			});

		}
	});		
</script>
@endsection
