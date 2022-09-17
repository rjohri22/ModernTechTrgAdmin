@extends('admin.layout.master')
@section('content')
@php
use App\Models\Job_applications;
@endphp
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						@if(isset($approved))
						<h5 class="card-title d-inline">{{($approved ==  1) ? "Approved Jobs" : "Jobs"}}</h5>
						@else
						<h5 class="card-title d-inline">Jobs</h5>
						@endif
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.add_job')}}" class="btn btn-primary" style="float: right;">Add Job</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table  class="table table-bordered table-hover datatable">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Job Id</th>
								<th scope="col">Oppertinity Id</th>
								<th scope="col">Profile</th>
								<th scope="col">Business</th>
								<th scope="col">Country</th>
								<th scope="col">State</th>
								<th scope="col">Location</th>
								<th scope="col">Created By</th>
								<th scope="col">Status</th>
								<th scope="col">Hr Approved</th>
								<th scope="col">Country Head Approved</th>
								<th scope="col">Hr Head Approved</th>
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
								<td>{{$job->job_unique_id}}</td>
								<td>{{($job->oppertunity_id) ? $job->oppertunity_id: "-"}}</td>
								<td>{{$job->bend_id}}</td>
								<td>{{$job->company_name}}</td>
								<td>{{$job->country_name}}</td>
								<td>{{$job->state_name}}</td>

								<td>{{$job->city_name}}</td>
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
											<!-- <button type="button" class="btn btn-sm btn-success" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Approval Need" data-bs-html="true" data-bs-content="<a href='{{route('admin.approve_hr',$job->id)}}' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-success btn-sm load_m'>Approved</a>&nbsp;<a class='btn btn-danger btn-sm'>Reject</a>">Change Status</button> -->
											<button type="button" class="btn btn-primary btn-success btn-sm hr_app_btn" data-bs-toggle="modal" data-bs-target="#hr_approval" data-action="{{route('admin.store_approv_hr',$job->id)}}">
											  approve
											</button>

											<!-- <button type="button" class="btn btn-primary btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hr_approval">
											  Reject
											</button> -->

											<!-- <button type="button" class="btn btn-sm btn-success" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Approval Need" data-bs-html="true" data-bs-content="<a data-bs-toggle='modal' data-bs-target='#hr_approval' class='btn btn-success btn-sm load_m'>Approved</a>&nbsp;<a class='btn btn-danger btn-sm'>Reject</a>">Change Status</button> -->

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

								@if($login_details->name == 'Country Head')
								<td>
									@if($job->country_head_approval != null)
										Approved
									@else
										@if($job->approved_hr != null)
											<button type="button" class="btn btn-primary btn-success btn-sm ch_app_btn" data-bs-toggle="modal" data-bs-target="#country_approval" data-action="{{route('admin.store_approv_country',$job->id)}}">
											  approve
											</button>

											<!-- <button type="button" class="btn btn-primary btn-danger btn-sm">
											  Reject
											</button>
 -->
											<!-- 
											<button type="button" class="btn btn-sm btn-success" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Approval Need" data-bs-html="true" data-bs-content="<a href='{{route('admin.approve_hr',$job->id)}}' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-success btn-sm load_m'>Approved</a>&nbsp;<a class='btn btn-danger btn-sm'>Reject</a>">Change Status</button> -->
										@else
											Pending
										@endif
									@endif
								</td>
								@else
								<td>
									@if($job->country_head_approval != null)
										Approved
									@else
										Pending
									@endif
								</td>
								@endif

								@if($login_details->name == 'HR Manager Head')
									<td>
										@if($job->hr_head_approval != null)
											Approved
										@else
											@if($job->country_head_approval != null)
												<button type="button" class="btn btn-primary btn-success btn-sm hr_head_app_btn" data-bs-toggle="modal" data-bs-target="#hr_head_approval" data-action="{{route('admin.store_approv_hr_head',$job->id)}}">
												  Approve
												</button>

												<!-- <button type="button" class="btn btn-primary btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hr_approval">
												  Reject
												</button> -->

												<!-- <button type="button" class="btn btn-sm btn-success" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Approval Need" data-bs-html="true" data-bs-content="<a href='{{route('admin.approve_hr',$job->id)}}' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-success btn-sm load_m'>Approved</a>&nbsp;<a class='btn btn-danger btn-sm'>Reject</a>">Change Status</button> -->
											@else
												pending
											@endif
										@endif
									</td>
								@else
									<td>
										@if($job->hr_head_approval != null)
											Approved
										@else
											Pending
										@endif
									</td>
								@endif

								<td>
									@if($job->is_draft =='1')
									<a href="{{route('admin.publish_jobs',$job->id)}}" class="btn btn-warning btn-sm">Publish</a>
									@endif
									<a href="{{route('admin.view_job',$job->id)}}" class="btn btn-primary btn-sm">View</a>
									@if($job->approved_hr == null)
									<a href="{{route('admin.edit_job',$job->id)}}" class="btn btn-info btn-sm">Edit</a>
									@endif
									<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Oppertunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_job',$job->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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
	</main>
</div>

<!-- 
<div class="box box-primary container mt-2" style="background: white">
	<br>
	<div class="box-header with-border">
		<a href="{{route('admin.add_job')}}" class="btn btn-primary" style="float: right;">Add Jobs</a>
		@if(isset($approved))
		<h3>{{($approved ==  1) ? "Approved Jobs" : "Jobs"}}</h3>
		@else
		<h3>Jobs</h3>
		@endif
	</div>
	<div class="box-body">
		
	</div>
</div> -->


<div class="modal" tabindex="-1" id="hr_approval">
  <div class="modal-dialog">
	<form action="" method="post" id="hr_from">
		@csrf
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">HR APPROVAL</h4>
		</div>
		<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<label>Work Type</label>
						<select class="form-control" name="work_type" id="objectives">
							<option value="">Select Objective</option>
							<option value="2">Full Time</option>
							<option value="1">Part Time</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Work Shift</label>
						<select class="form-control" name="work_shift" id="objectives">
							<option value="">Select Shift</option>
							<option value="day">Day</option>
							<option value="night">Night</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Work Style</label>
						<select class="form-control" name="work_style" id="objectives">
							<option value="">Select Shift</option>
							<option value="onsite">Onsite</option>
							<option value="remote">Remote</option>
							<option value="hybrid">Hybrid</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Remarks</label>
						<textarea class="form-control" rows="5" name="hr_remark"></textarea>
					</div>
				</div>
		</div>

		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="save" value="Save">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	</form>
</div>
</div>




<div class="modal" tabindex="-1" id="country_approval">
  <div class="modal-dialog">
	<form action="" method="post" id="country_from">
		@csrf
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Country Head APPROVAL</h4>
		</div>
		<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<label>Min Salary</label>
						<input type="number" name="min_salary" class="form-control">
					</div>

					<div class="col-sm-6">
						<label>Max Salary</label>
						<input type="number" name="max_salary" class="form-control">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Wages</label>
						<select class="form-control" name="wages" id="wages">
							<option value="">Select Wages</option>
							<option value="monthly">Monthly</option>
							<option value="anually">Anually</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Compensation Mode</label>
						<select class="form-control" name="compensation_mode" id="compensation_mode">
							<option value="">Select Compensation Mode</option>
							<option value="solely_salary">Solely Salary</option>
							<option value="base_commission">Base+Commission</option>
							<option value="commission">Commission Only</option>
						</select>
					</div>
				</div>
		</div>

		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="save" value="Save">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	</form>
</div>
</div>



<div class="modal" tabindex="-1" id="hr_head_approval">
  <div class="modal-dialog">
	<form action="" method="post" id="hr_head_from">
		@csrf
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">HR Head APPROVAL</h4>
		</div>
		<div class="modal-body">
				<div class="row">
					<table class="table table-bordered">
						<tr>
							<th rowspan="2">ROUND 1</th>
							<th>No Of Question</th>
							<th>Passing Marks</th>
						</tr>
						<tr>
							<td><input type="number" name="round_1_question" class="form-control"></td>
							<td><input type="number" name="round_1_pass_mark" class="form-control"></td>
						</tr>
					</table>

					<table class="table table-bordered">
						<tr>
							<th rowspan="2">ROUND 2</th>
							<th>No Of Question</th>
							<th>Passing Marks</th>
						</tr>
						<tr>
							<td><input type="number" name="round_2_question" class="form-control"></td>
							<td><input type="number" name="round_2_pass_mark" class="form-control"></td>
						</tr>
					</table>

					<table class="table table-bordered">
						<tr>
							<th rowspan="2">ROUND 3</th>
							<th>No Of Question</th>
							<th>Passing Marks</th>
						</tr>
						<tr>
							<td><input type="number" name="round_3_question" class="form-control"></td>
							<td><input type="number" name="round_3_pass_mark" class="form-control"></td>
						</tr>
					</table>
				</div>
				
		</div>

		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="save" value="Save">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	</form>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.hr_app_btn').click(function(){
			var action = $(this).attr('data-action');
			console.log(action);
			$('#hr_from').attr('action',action);
		});

		$('.ch_app_btn').click(function(){
			var action = $(this).attr('data-action');
			console.log(action);
			$('#country_from').attr('action',action);
		});

		$('.hr_head_app_btn').click(function(){
			var action = $(this).attr('data-action');
			console.log(action);
			$('#hr_head_from').attr('action',action);
		});
	});
</script>

@endsection