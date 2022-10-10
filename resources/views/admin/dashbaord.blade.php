@extends('admin.layout.master')

@section('content')
<style type="text/css">
	.mdc-card.info-card .card-inner{
		margin: 0px;
	}
</style>
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<h5 class="card-title">JobSeeker</h5>
				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-warning p-3">
							<div class="inner">
								<h3>44</h3>
								<p>Total Users</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-warning p-3">
							<div class="inner">
								<h3>{{$total_oppertunity}}</h3>
								<p>Total Jobs</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-warning p-3">
							<div class="inner">
								<h3>{{$total_jobseeker}}</h3>
								<p>Total Jobseeker</p>
							</div>
							<div class="icon">
								<i class="ion ion-stats-bars"></i>
							</div>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6 bg-warning p-3">
						<!-- small box -->
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3>{{$total_applications}}</h3>
								<p>Total Applications</p>
							</div>
							<div class="icon">
								<i class="ion ion-person-add"></i>
							</div>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-green bg-warning p-3">
							<div class="inner">
								<h3>{{$total_oppertunity}}</h3>
								<p>Total Approved Jobs</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
						</div>
					</div>
					<!-- /col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-red bg-warning p-3">
							<div class="inner">
								<h3>{{$total_oppertunity}}</h3>
								<p>Total pendings</p>
							</div>
							<div class="icon">
								<i class="ion ion-bag"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<!-- <div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<a href="{{route('admin.viewjob')}}" class="btn btn-primary" style="float: right;">view</a>
				<h5 class="card-title">Latest Jobs</h5>
				<br>
				<div class="row">
					@php
					use App\Models\Job_applications;
					use App\Models\Jobs;
					@endphp
					<div class="table-responsive">
						<table  class="table table-bordered table-hover ">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Title</th>
									<th scope="col">Company</th>
									<th scope="col">Country</th>
									<th scope="col">State</th>
									<th scope="col">Location</th>
									<th scope="col">Salary</th>
									<th scope="col">Salary Type</th>
									<th scope="col">Work Type</th>
									<th scope="col">Job Type</th>
									<th scope="col">Expires On</th>
									<th scope="col">Head Count</th>
									<th scope="col">Urgent Hirign</th>
									<th scope="col">Created By</th>
									<th scope="col">Status</th>
									<th scope="col">Hr Approved</th>
									<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>


								@php
								{{$counter = 1;}}
								@endphp
								@foreach($jobs as $job) 
								<tr>
									<th scope="row">{{$counter}}</th>
									<td>{{$job->title}}</td>
									<td>{{$job->company_name}}</td>
									<td>{{$job->country_name}}</td>
									<td>{{$job->state_name}}</td>

									<td>{{$job->city_name}}</td>
									<td>{{($job->min_salary) ? $job->min_salary : 0}} To {{($job->max_salary) ? $job->max_salary : 0}}</td>
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
									<td>
										@if($job->work_type =='1')
										Part Time
										@elseif($job->work_type =='2')
										Full Time
										@else
										<i>Not Specified</i>       
										@endif
									</td>
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
									<td>{{date('d-M-Y',strtotime($job->expires_on))}}</td>
									<td>{{$job->no_of_positions}}</td>
									<td>{{($job->urgent_hiring) ? "Yes": " No "}}</td>
									<td>{{$job->first_name}}</td>

									@if($job->modified_by != $login_details->user_id || $master_bend == true)
									@if($job->approved_manager != null)
									<td>Approved By Manager</td>
									@else
									<td><a href="{{route('admin.job_approved_manager',$job->id)}}" class="btn btn-success">Approve</a></td>
									@endif
									@else
									@if($job->approved_manager != null)
									<td>Approved By Manager</td>
									@else
									<td>Pending</td>
									@endif
									@endif
									@if($login_details->name == 'HR Manager')
									<td>
										@if($job->approved_hr != null)
										Approved By Hr
										@else
										@if($job->approved_manager != null)
										<a class="btn btn-success" href="{{route('admin.assign_objective',$job->id)}}" data-toggle="modal" data-target="#myModal" >Approve</a>
										<!-- <a href="{{route('admin.job_approved_hr',$job->id)}}" class="btn btn-success">Approved</a> -->

										@else
										Manager Approval Pending

										@endif
										@endif
									</td>
									@else
									<td>
										@if($job->approved_hr != null)
										Approved By Hr
										@else
										Approval Pending hr
										@endif
									</td>
									@endif

									<td>
										<a href="{{route('admin.view_job',$job->id)}}" class="btn btn-primary btn-sm">View</a>
										@if($job->approved_hr == null)
										<a href="{{route('admin.edit_job',$job->id)}}" class="btn btn-info btn-sm">Edit</a>
										@endif
										<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_job',$job->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

									</td>
								</tr>
								@php
								{{$counter++;}}
								@endphp
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>
<!-- Small boxes (Stat box) -->

<!-- 
<div class="box box-primary container mt-2" style="background: white">
	<br>
	<div class="box-header with-border">
		
		@if(isset($approved))
		<h3>{{($approved ==  1) ? "Approved Jobs" : "Jobs"}}</h3>
		@else
		<h3>Jobs</h3>
		@endif
	</div>
	<div class="box-body">
		
	</div>
</div> -->




@stop

