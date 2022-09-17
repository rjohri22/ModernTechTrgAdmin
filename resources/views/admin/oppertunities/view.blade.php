@extends('admin.layout.master')
@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<h5>Veiw Job Description</h5>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
			<tr>
				<th style="width: 50%">Profile</th>
				<td style="width: 50%">{{$oppertunity->bend_name}}</td>
			</tr>
			<!-- <tr>
				<th>Company</th>
				<td>{{$oppertunity->company_name}}</td>
			</tr> -->
			<tr>
				<th>Daily Job</th>
				<td>{{$oppertunity->daily_job}}</td>
			</tr>

			<tr>
				<th>Responsibilities</th>
				<td>{{$oppertunity->Responsibilities}}</td>
			</tr>

			<tr>
				<th>KPI</th>
				<td>{{$oppertunity->summery}}</td>
			</tr>

			
			<tr>
				<th>Eligibility Criteria</th>
				<td>{{$oppertunity->description}}</td>
			</tr>

			
			<!-- <tr>
				<th>Team Engagement</th>
				<td>{{$oppertunity->team_engagement}}</td>
			</tr>
			<tr>
				<th>Reporting</th>
				<td>{{$oppertunity->reporting}}</td>
			</tr> -->
			<!-- <tr>
				<th>Salary Type</th>
				<td>

					@if($oppertunity->salary_type =='1')
			      		Monthly
					@elseif($oppertunity->salary_type =='2')
					    Yearly
					@elseif($oppertunity->salary_type =='3')
					    Daily
					@else
					 	<i>Not Specified</i>       
					@endif

				</td>
			</tr> -->
			<!-- <tr>
				<th>Job Type</th>
				<td>
					@if($oppertunity->job_type =='1')
			      		Internship
					@elseif($oppertunity->job_type =='2')
					    Fresher
					@elseif($oppertunity->job_type =='3')
					    Experienced
					@else
					 	<i>Not Specified</i>       
					@endif
				</td>
			</tr> -->
			<!-- <tr>
				<th>Work Type</th>
				<td>
					@if($oppertunity->work_type =='1')
			      		Part Time
					@elseif($oppertunity->work_type =='2')
					    Full Time
					@else
					 	<i>Not Specified</i>       
					@endif
				</td>
			</tr>
			<tr>
				<th>Profile</th>
				<td>{{$oppertunity->profile}}</td>
			</tr>
			
			<tr>
				<th>Summery</th>
				<td>{{$oppertunity->summery}}</td>
			</tr>
			<tr>
				<th>Description</th>
				<td>{{$oppertunity->description}}</td>
			</tr>
			<tr>
				<th>Expires on</th>
				<td>{{$oppertunity->expires_on}}</td>
			</tr> -->
			<!-- <tr>
				<th>No Of Postions</th>
				<td>{{$oppertunity->no_of_positions}}</td>
			</tr> -->
			<!-- <tr>
				<th>urgent Hiring</th>
				<td>{{($oppertunity->urgent_hiring == 1) ? "Yes" : "No"}}</td>
			</tr>
			<tr>
				<th>Status</th>
				<td>{{($oppertunity->status == 1) ? "Open" : "Closed"}}</td>
			</tr> -->
		</table>
			</div>
		</div>
	</main>
</div>


<!-- 
<div class="box box-primary container mt-2" style="background: white">
	<br>

	<div class="box-header">
		<h3>View Job Description</h3>
	</div>
	<div class="box-body">
		

		<a href="{{route('admin.oppertunities')}}" class="btn btn-primary">Back to list</a>
		
	</div>
</div>
 -->

@endsection