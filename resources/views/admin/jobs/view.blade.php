@extends('admin.layout.master')
@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						View Job
					</div>
					
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<table class="table table-bordered">
							<tr>
								<th colspan="2" class="bg-dark text-white">Basic Information</th>
							</tr>
							<tr>
								<th>Job Id</th>
								<td>{{$job->job_unique_id}}</td>
							</tr>
							<tr>
								<th>Oppertunity Id</th>
								<td>{{($job->oppertunity_id) ? $job->oppertunity_id : "Pending"}}</td>
							</tr>
							<tr>
								<th>Profile</th>
								<td>{{$job->band_id}}</td>
							</tr>
							<tr>
								<th>Business</th>
								<td>{{$job->company_name}}</td>
							</tr>

							<tr>
								<th>Country</th>
								<td>{{$job->country_name}}</td>
							</tr>

							<tr>
								<th>State</th>
								<td>{{$job->state_name}}</td>
							</tr>

							<tr>
								<th>City</th>
								<td>{{$job->city_name}}</td>
							</tr>
						</table>
					</div>

					<div class="col-md-6">
						
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered" style="table-layout: fixed;">
							<tr>
								<th class="bg-dark text-white">Job Description</th>
							</tr>
							<tr>
								<th >Daily Job</th>
							</tr>
							<tr>
								<td ><span>{{strip_tags($job->daily_job)}}</span></td>
							</tr>
							<tr>
								<th>Responsibility</th>
							</tr>
							<tr>
								<td>{{strip_tags($job->responsibilities)}}</td>
							</tr>

							<tr>
								<th>KPI</th>
							</tr>
							<tr>
								<td>{{strip_tags($job->summery)}}</td>
							</tr>

							<tr>
								<th>Eligilibity Criteria</th>
							</tr>
							<tr>
								<td>{{strip_tags($job->description)}}</td>
							</tr>
						</table>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4">
						<table class="table table-bordered">
							<tr>
								<th colspan="2" class="bg-dark text-white">Hr Approval</th>
							</tr>
							<tr>
								<th>Status</th>
								<td>{{($job->approved_hr != null) ? "Approved" : "Pending"}}</td>
							</tr>
							<tr>
								<th>Work Type</th>
								@php
									$work_type = "Not Specified";
									if($job->work_type == 1){
										$work_type = "Part Time";
									}else if($job->work_type == 2){
										$work_type = "Full Time";
									}
								@endphp
								<td>{{$work_type}}</td>
							</tr>

							<tr>
								<th>Work Shift</th>
								<td>{{$job->work_shift}}</td>
							</tr>

							<tr>
								<th>Work Style</th>
								<td>{{$job->work_style}}</td>
							</tr>

							<tr>
								<th>Remarks</th>
								<td>{{$job->hr_remarks}}</td>
							</tr>
						</table>
					</div>

					<div class="col-md-4">
						<table class="table table-bordered">
							<tr>
								<th colspan="2" class="bg-dark text-white">Country Head Approval</th>
							</tr>
							<tr>
								<th>Status</th>
								<td>{{($job->country_head_approval != null) ? "Approved" : "Pending"}}</td>
							</tr>
							<tr>
								<th>Salary Range</th>
								<td>{{$job->min_salary}} - {{$job->max_salary}}</td>
							</tr>

							<tr>
								<th>Wages</th>
								@php
									$salary_type = "Not Specified";
									if($job->salary_type == 1){
										$salary_type = "Monthly";
									}else if($job->salary_type == 2){
										$salary_type = "Yearly";
									}
									else if($job->salary_type == 3){
										$salary_type = "Daily";
									}
								@endphp
								<td>{{$salary_type}}</td>
							</tr>

							<tr>
								<th>Compensation Mode</th>
								<td>{{$job->compensation_mode}}</td>
							</tr>
						</table>
					</div>

					<div class="col-md-4">
						<table class="table table-bordered">
							<tr>
								<th colspan="2" class="bg-dark text-white">HR Manage Head Approval</th>
							</tr>
							<tr>
								<th>Status</th>
								<td>{{($job->hr_head_approval != null) ? "Approved" : "Pending"}}</td>
							</tr>
							<tr>
								<th>Round 1 Question / Total Marks</th>
								<td>{{$job->round_1_question}} / {{$job->round_1_pass_mark}}</td>
							</tr>

							<tr>
								<th>Round 2 Question / Total Marks</th>
								<td>{{$job->round_2_question}} / {{$job->round_2_pass_mark}}</td>
							</tr>

							<tr>
								<th>Round 3 Question / Total Marks</th>
								<td>{{$job->round_3_question}} / {{$job->round_3_pass_mark}}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>


@endsection