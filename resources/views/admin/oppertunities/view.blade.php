@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<br>

	<div class="box-header">
		<h3>Add Opportunities</h3>
	</div>
	<div class="box-body">
		<table class="table table-bordered">
			<tr>
				<th style="width: 50%">Title</th>
				<td style="width: 50%">{{$oppertunity->title}}</td>
			</tr>
			<!-- <tr>
				<th>Company</th>
				<td>{{$oppertunity->company_name}}</td>
			</tr> -->
			<tr>
				<th>Min Salary</th>
				<td>{{$oppertunity->min_salary}}</td>
			</tr>
			<tr>
				<th>Max Salary</th>
				<td>{{$oppertunity->max_salary}}</td>
			</tr>
			<tr>
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
			</tr>
			<tr>
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
			</tr>
			<tr>
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
			</tr>
			<tr>
				<th>No Of Postions</th>
				<td>{{$oppertunity->no_of_positions}}</td>
			</tr>
			<tr>
				<th>urgent Hiring</th>
				<td>{{($oppertunity->urgent_hiring == 1) ? "Yes" : "No"}}</td>
			</tr>
			<tr>
				<th>Status</th>
				<td>{{($oppertunity->status == 1) ? "Open" : "Closed"}}</td>
			</tr>
		</table>

		<a href="{{route('admin.oppertunities')}}" class="btn btn-primary">Back to list</a>
		
	</div>
</div>


@endsection