@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit Application</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.update_interview',$job_application->id)}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<label>Select Hod</label>
					<select class="form-control" name="hod">
						<option value="1">Select Hod</option>
						<option value="0">Hod</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label>interview Date</label>
					<input type="date" name="interview_date" class="form-control" value="{{date('Y-m-d',strtotime($job_application->company_interview_datetime))}}">
				</div>
				<div class="col-sm-3">
					<label>Joining Date</label>
					<input type="date" name="Joining_date" class="form-control" value="{{$job_application->joining_date}}">
				</div>
				<div class="col-sm-3">
					<label>Offer Salary</label>
					<input type="number" name="offer_salary" class="form-control" value="{{$job_application->offer_salary}}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					<label>Offer Letter Status</label>
					<select class="form-control" name="offer_letter">
						<option value="">Select Status</option>
						<option value="0" {{($job_application->offer_letter_status == 0) ? 'selected' : ''}}>Pending</option>
						<option value="1" {{($job_application->offer_letter_status == 1) ? 'selected' : ''}}>Approved</option>
						<option value="2" {{($job_application->offer_letter_status == 2) ? 'selected' : ''}}>Reject</option>
					</select>
				</div>
				<div class="col-sm-3">
					<label>Status</label>
					<select class="form-control" name="status" readonly="true">
						<option value="">Select Status</option>
						<option value="0" {{($job_application->status == 0) ? 'selected' : ''}}>Pending</option>
						<option value="1" {{($job_application->status == 1) ? 'selected' : ''}}>Shorlist</option>
						<option value="2" {{($job_application->status == 2) ? 'selected' : ''}}>Reject</option>
						<option value="3" {{($job_application->status == 3) ? 'selected' : ''}}>Interviewd</option>
						<option value="4" {{($job_application->status == 4) ? 'selected' : ''}}>Onboarding</option>
						<option value="5" {{($job_application->status == 5) ? 'selected' : ''}}>Hiring</option>
					</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label>Interview Feedbacks</label>
					<textarea class="form-control" rows="7" name="interview_feedback">{{$job_application->interview_feebacks}}</textarea>
				</div>				
			</div>
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