@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Edit Business Location</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.business_location_update',$business_location->id)}}" method="post">
					@csrf
					<div class="row">
						<div class="col-sm-3">
							<label>Business</label>
							<select class="form-control" name="company_id" id="company_id">
								@foreach ($companies as $company)
								<option value="{{ $company->id }}" @if ($company->id == $business_location->company_id) selected @endif >{{ $company->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-sm-4">
							<label>Country</label>
							<select class="form-control" name="country_id" id="country">
								@foreach ($countries as $country)
								<option value="{{ $country->id }}" @if ($country->id == $business_location->country_id) selected @endif >{{ $country->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-4">
							<label>State</label>
							<select class="form-control" name="state_id" id="state">
							</select>
						</div>
						<div class="col-sm-4">
							<label>City</label>
							<select class="form-control" name="city" id="cities" >
							</select>
						</div>
						
						<div class="col-sm-4">
							<label>Active</label>
							<select class="form-control" name="status">
								<option value="1" @if ($business_location->status == 1) selected @endif >Active</option>
								<option value="0" @if ($business_location->status == 0) selected @endif >Inactive</option>
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
	</main>
</div>

<!-- 
<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit Busniess</h3>
	</div>
	<div class="box-body">
		
		
	</div>
</div>
 -->

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
					$('#state').val({{$business_location->state_id}});
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
					$('#cities').val({{$business_location->city}});
				}
			});

		}
	});		
</script>
@endsection
