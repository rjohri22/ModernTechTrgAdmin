@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Add Busniess</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.store_job')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Job Description</label>
					<select class="form-control" name="jd" id="jd">
						@foreach ($job_descrtiption as $jd)
						<option value="{{ $jd->id }}">{{ $jd->title }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-4">
					<label>Company</label>
					<select class="form-control" name="company_id" id="company_id">
						@foreach ($companies as $company)
						<option value="{{ $company->id }}">{{ $company->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country_id" id="country">
						@foreach ($countries as $country)
						<option value="{{ $country->id }}">{{ $country->name }}</option>

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
					<select class="form-control" name="city_id" id="cities" >
					</select>
				</div>
			</div>
			<br>
			
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
