@extends('admin.layout.master')
@section('content')
<style>
	.sweet-warning{
		background-color: blue;
	}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">
		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<h5>Add Job</h5>
			</div>
			<div class="card-body">
				<form action="{{route('admin.store_job')}}" method="post">
					@csrf
					<div class="row">
						<div class="col-sm-4">
							<label>Profile</label>
							<select class="form-control" name="bend_id" id="bend_id">
								@foreach($bend_details as $b)
								<option value="{{ $b->id }}">{{ $b->name }}</option>
								@endforeach

							</select>
						</div>
						<div class="col-sm-4">
							<label>Business</label>
							<select class="form-control" name="company_id" id="company_id">
								@foreach ($companies as $company)
								<option value="{{ $company->id }}" data-code="{{$company->business_code}}">{{ $company->name }}</option>
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
						
						<!-- <div class="col-sm-4">
							<label>Head Count</label>
							<input type="number" name="no_of_positions" class="form-control">
						</div> -->
					</div>
					<br>
					@if($my_bend->level >= 4)
					<div class="row">
						
						<div class="col-sm-3">
							<label>Work Type</label>
							<select class="form-control" name="work_type" id="objectives">
								<option value="">Select Work Type</option>
								<option value="2">Full Time</option>
								<option value="1">Part Time</option>
							</select>
						</div>

						<div class="col-sm-3">
							<label>Work Shift</label>
							<select class="form-control" name="work_shift" id="objectives">
								<option value="">Select Shift</option>
								<option value="day">Day</option>
								<option value="night">Night</option>
							</select>
						</div>

						<div class="col-sm-3">
							<label>Work Style</label>
							<select class="form-control" name="work_style" id="objectives">
								<option value="">Select Shift</option>
								<option value="onsite">Onsite</option>
								<option value="remote">Remote</option>
								<option value="hybrid">Hybrid</option>
							</select>
						</div>

						<div class="col-md-12">
							<label>Remarks</label>
							<textarea class="form-control" rows="5" name="hr_remark"></textarea>
						</div>
					</div>
					<br>
					@endif
 
					@if( !empty($countryhead) && $my_bend->level >= $countryhead->level):
						<div class="row">
							<div class="col-md-3">
								<label>Min Salary</label>
								<input type="number" name="min_salary" class="form-control">
							</div>
	
							<div class="col-md-3">
								<label>Max Salary</label>
								<input type="number" name="max_salary" class="form-control">
							</div>
							<div class="col-md-3">
								<label>Wages</label>
								<select class="form-control" name="wages" id="wages">
									<option value="">Select Wages</option>
									<option value="monthly">Monthly</option>
									<option value="anually">Anually</option>
								</select>
							</div>
							<div class="col-md-3">
								<label>Compensation Mode</label>
								<select class="form-control" name="compensation_mode" id="compensation_mode">
									<option value="">Select Compensation Mode</option>
									<option value="solely_salary">Solely Salary</option>
									<option value="base_commission">Base+Commission</option>
									<option value="commission">Commission Only</option>
								</select>
							</div>
						</div>
					@endif
					<div class="row">
						<div class="col-sm-12" id="warning_msg">
							<div class="alert alert-warning">
								<strong>Warning ! </strong>
								<br>
								<p>Interview Round Has Not Been Created For this Profile</p>
								<a href="{{route('admin.interview_rounds')}}" class="btn btn-warning">Create Round</a>
							</div>
						</div>
						<div class="col-sm-12">
							<input type="hidden" name="job_unique_id" id="job_unique_id">
							<button class="btn btn-primary" type="submit" style="float: right" id="save_btn">Save</button>
							<button class="btn btn-warning" type="submit" name="savedraft" id="save_btn_dr" value="1" style="float: right;margin-right: 6px;margin-bottom: 15px;" >Save Draft</button>
						</div>
					</div>
					<br>
				</form>
			</div>
		</div>
	</main>
</div>
@endsection
@section('footer')
<script>
	$(document).ready(function(){
		$('#warning_msg').hide();
		$('#bend_id').change(function(){
			var bend_id = $(this).val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.load_interview_round')}}",
				type: 'POST',
				data: {bend_id:bend_id},
				success: function(data) {
					if(data.codestatus == true){
						$('#warning_msg').hide();
						$('#save_btn').attr('disabled',false);
						$('#save_btn_dr').attr('disabled',false);
					}else{
						$('#warning_msg').show();
						$('#save_btn').attr('disabled',true);
						$('#save_btn_dr').attr('disabled',true);
					}
					console.log(data);
					// $('#country').html(data.html);
					// loadstate();
				}
			});
		});

		$('#company_id').change(function(){
			var status = $('#company_id option:selected').attr('data-code');
			console.log(status);
			$('#job_unique_id').val(status);
		});
		$('#company_id').trigger('change');
		$('#company_id').change(function(){
			console.log('change company');
			loadcountry();
		});
		loadcountry();
		function loadcountry(){
			console.log('Load country');
			var id = $('#company_id').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.load_business_country')}}",
				type: 'POST',
				data: {id:id},
				success: function(data) {
					$('#country').html(data.html);
					loadstate();
				}
			});
		}

		$('#country').change(function(){
			console.log('change country');
			loadstate();
		});

		loadstate();
		function loadstate(){
			console.log('Load States');
			var id = $('#company_id').val();
			var id = $('#country').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.load_business_state')}}",
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
				url: "{{route('admin.load_business_city')}}",
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