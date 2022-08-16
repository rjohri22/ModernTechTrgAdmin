@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<br>

	<div class="box-header">
		<h3>Jobs</h3>
	</div>
	<div class="box-body">
		<table class="table table-bordered">
			<tr>
				<th style="width: 50%">Title</th>
				<td style="width: 50%">{{$job->title}}</td>
			</tr>
			<tr>
				<th>Company</th>
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
			<tr>
				<th>Min Salary</th>
				<td>{{$job->min_salary}}</td>
			</tr>
			<tr>
				<th>Max Salary</th>
				<td>{{$job->max_salary}}</td>
			</tr>
			<tr>
				<th>Salary Type</th>
				<td>

					@if($job->salary_type =='1')
			      		Monthly
					@elseif($job->salary_type =='2')
					    Yearly
					@elseif($job->salary_type =='3')
					    Daily
					@else
					 	<i>Not Specified</i>       
					@endif

				</td>
			</tr>
			<tr>
				<th>Job Type</th>
				<td>
					@if($job->job_type =='1')
			      		Internship
					@elseif($job->job_type =='2')
					    Fresher
					@elseif($job->job_type =='3')
					    Experienced
					@else
					 	<i>Not Specified</i>       
					@endif
				</td>
			</tr>
			<tr>
				<th>Work Type</th>
				<td>
					@if($job->work_type =='1')
			      		Part Time
					@elseif($job->work_type =='2')
					    Full Time
					@else
					 	<i>Not Specified</i>       
					@endif
				</td>
			</tr>
			<tr>
				<th>Summery</th>
				<td>{{$job->summery}}</td>
			</tr>
			<tr>
				<th>Description</th>
				<td>{{$job->description}}</td>
			</tr>
			<tr>
				<th>Expires on</th>
				<td>{{date('d-M-Y',strtotime($job->expires_on))}}</td>
			</tr>
			<tr>
				<th>No Of Postions</th>
				<td>{{$job->no_of_positions}}</td>
			</tr>
			<tr>
				<th>urgent Hiring</th>
				<td>{{($job->urgent_hiring == 1) ? "Yes" : "No"}}</td>
			</tr>
			<tr>
				<th>Status</th>
				<td>{{($job->status == 1) ? "Approved" : "Pending"}}</td>
			</tr>
		</table>

		<a href="{{route('admin.jobs')}}" class="btn btn-primary">Back to list</a>
		
	</div>
</div>


@endsection