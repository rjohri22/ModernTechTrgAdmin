@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Add Business Location</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.business_location_store')}}" method="post">
					@csrf
					<div class="row">
						<div class="col-sm-3">
							<label>Business</label>
							<select class="form-control" name="company_id" id="company_id">
								@foreach ($companies as $company)
								<option value="{{ $company->id }}">{{ $company->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-3">
							<label>Country</label>
							<select class="form-control" name="country_id[]" id="country" multiple >
								@foreach ($countries as $country)
								<option value="{{ $country->id }}">{{ $country->name }}</option>

								@endforeach
							</select>
						</div>
						<div class="col-sm-3">
							<label>State</label>
							<select class="form-control" name="state_id[]" id="state" multiple >
							</select>
						</div>
						<div class="col-sm-3">
							<label>City</label>
							<select class="form-control" name="city[]" id="cities" multiple >
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-3">
							<label>Active</label>
							<select class="form-control" name="status">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
						</div>
					</div>
					
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
		<h3>Add Business Location</h3>
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
