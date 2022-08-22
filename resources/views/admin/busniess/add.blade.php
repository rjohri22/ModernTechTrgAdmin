@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Add Busniess</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.busniess_store')}}" enctype="multipart/form-data" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Title</label>
					<input type="text" name="title" class="form-control">
				</div>
				<!-- <div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country" id="country">
						@foreach ($countries as $country)
						<option value="{{ $country->id }}">{{ $country->name }}</option>

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
					<input type="text" name="address" class="form-control">
				</div>
				<div class="col-sm-4">
					<label>Bussiness Logo</label>
					<input type="file" name="business_logo" class="form-control">
				</div>
				<div class="col-sm-4">
					<label>Business URL</label>
					<input type="text" name="business_url" class="form-control">
				</div>
				
				<!-- <div class="col-sm-4">
					<label>Decription</label>
					<textarea type="textarea" name="address" class="form-control">
					</textarea>	
				</div> -->
				<div class="col-sm-4">
					<label>Active</label>
					<select class="form-control" name="status">
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</div>
				<div class="col-sm-12">
					<label>Summary</label>
					<textarea name="Summary" class="form-control">
</textarea>
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
				}
			});

		}
	});		
</script>
@endsection
