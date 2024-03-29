@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />


<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<h5>Edit Job</h5>
			</div>
			<div class="card-body">
				<form action="{{route('admin.update_job',$job->id)}}" method="post">
			@csrf
			<div class="row">
				<!-- <div class="col-sm-3">
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="{{$job->title}}">
				</div> -->
				<div class="col-sm-4">
					<label>Profile</label>
					<select class="form-control" name="bend_id" id="bend_id">
					
						<option value="{{ $bend_details->id }}">{{ $bend_details->name }}</option>
					
					</select>
				</div>
				<div class="col-sm-4">
					<label>Company</label>
					<select name="company_id" class="form-control">
						<option value="">Select Company</option>
						@foreach($companies as $company)
							@php
							$selected = ($company->id == $job->company_id) ? 'selected' : '';
							@endphp
							<option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country_id" id="country">
						@foreach ($countries as $country)
							@php
							$selected = ($country->id == $job->country_id) ? 'selected' : '';
							@endphp
							<option value="{{ $country->id }}" {{$selected}}>{{ $country->name }}</option>
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
			@if($my_bend->level >= $countryhead->level):
				<div class="row">
					<div class="col-md-3">
						<label>Min Salary</label>
						<input type="number" name="min_salary" class="form-control" value="{{ $job->min_salary }}" >
					</div>

					<div class="col-md-3">
						<label>Max Salary</label>
						<input type="number" name="max_salary" class="form-control" value="{{ $job->max_salary }}" >
					</div>
					<div class="col-md-3">
						<label>Wages</label>
						<select class="form-control" name="wages" id="wages">
							<option value="">Select Wages</option>
							<option value="monthly" {{ $job->salary_type == "monthly" ? 'selected' : '' }} >Monthly</option>
							<option value="anually" {{ $job->salary_type == "anually" ? 'selected' : '' }} >Anually</option>
						</select>
					</div>
					<div class="col-md-3">
						<label>Compensation Mode</label>
						<select class="form-control" name="compensation_mode" id="compensation_mode">
							<option value="">Select Compensation Mode</option>
							<option value="solely_salary" {{ $job->compensation_mode == "solely_salary" ? 'selected' : '' }} >Solely Salary</option>
							<option value="base_commission" {{ $job->compensation_mode == "base_commission" ? 'selected' : '' }} >Base+Commission</option>
							<option value="commission" {{ $job->compensation_mode == "commission" ? 'selected' : '' }} >Commission Only</option>
						</select>
					</div>
				</div>
			@endif
			<br>
			<!-- <div class="row">
				<div class="col-sm-3">
					<label>Salary Type</label>
					<select name="salary_type" class="form-control">
						<option value="1" {{($job->salary_type == 1) ? 'selected' : ''}}>Monthly</option>
						<option value="2" {{($job->salary_type == 2) ? 'selected' : ''}}>Yearly</option>
						<option value="3" {{($job->salary_type == 3) ? 'selected' : ''}}>Daily</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Job Type</label>
					<select name="job_type" class="form-control">
						<option value="1" {{($job->job_type == 1) ? 'selected' : ''}}>Internship</option>
						<option value="2" {{($job->job_type == 2) ? 'selected' : ''}}>Fresher</option>
						<option value="3" {{($job->job_type == 3) ? 'selected' : ''}}>Experienced</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Work Type</label>
					<select name="work_type" class="form-control">
						<option value="1" {{($job->work_type == 1) ? 'selected' : ''}}>Part Time</option>
						<option value="2" {{($job->work_type == 2) ? 'selected' : ''}}>Full Time</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Expired On</label>
					<input type="date" name="expires_on" class="form-control" value="{{$job->expires_on}}">
				</div>
			</div>
			<br> -->
			<!-- <div class="row">
				<div class="col-sm-3">
					<label>Head Count</label>
					<input type="number" name="no_of_position" class="form-control" value="{{$job->no_of_positions}}">
				</div>

				<div class="col-sm-3">
					<label>Urgent Hiring</label>
					<select name="urgent_hiring" class="form-control">
						<option value="1" {{($job->urgent_hiring == 1) ? 'selected' : ''}}>Yes</option>
						<option value="0" {{($job->urgent_hiring == 0) ? 'selected' : ''}}>No</option>
					</select>
				</div> -->

				<!-- <div class="col-sm-3">
					<label>Status</label>
					<select name="status" class="form-control">
						<option value="1" {{($job->status == 1) ? 'selected' : ''}}>Approved</option>
						<option value="0" {{($job->status == 0) ? 'selected' : ''}}>Pending</option>
					</select>
				</div> -->
			<!-- </div>
			<br> -->
			<!-- <div class="row">
				<div class="col-sm-12">
					<label>Summery</label>
					<textarea class="form-control" name="summery" rows="8">{{$job->summery}}</textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label>Description</label>
					<textarea class="form-control" name="description" rows="8">{{$job->description}}</textarea>
				</div>
			</div>
			<br> -->
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" type="submit" style="float: right">Edit Job Description</button>
				</div>
			</div>
		</form>
			</div>
		</div>
	</main>
</div>


<!-- <div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<h3>Edit Job</h3>
	</div>
	<div class="box-body">
		
		
	</div>
</div> -->

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
					$('#state').val({{$job->state_id}});
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
					$('#cities').val({{$job->city_id}});
				}
			});

		}
	});		
</script>
@endsection