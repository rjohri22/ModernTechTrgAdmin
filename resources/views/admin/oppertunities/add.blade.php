@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<h3>Add Job Description</h3>
	</div>
	<div class="box-body">
		
		<form action="{{url('admin/oppertunities/store_oppertunity')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<label>Title</label>
					<input type="text" name="title" class="form-control">
				</div>
				<div class="col-sm-3">
					<label>Band</label>
					<select name="bend_id" class="form-control">
						<option value="">Select Band</option>
						@foreach($bends as $bend)
						<option value="{{$bend->id}}">{{$bend->name}}</option>
						@endforeach
					</select>
				</div>
				<!-- <div class="col-sm-3">
					<label>Min Salary</label>
					<input type="number" name="min_salary" class="form-control">
				</div>
				<div class="col-sm-3">
					<label>Max Salary</label>
					<input type="number" name="max_salary" class="form-control">
				</div> -->
				<!-- <div class="col-sm-3">
					<label>Daily Job</label>
					<input type="text" name="daily_job" class="form-control">
				</div>
				<div class="col-sm-3">
					<label>Team Engagement</label>
					<input type="text" name="team_engagement" class="form-control">
				</div>
				<div class="col-sm-3">
					<label>Reporting</label>
					<input type="text" name="reporting" class="form-control">
				</div>
			</div> -->
			
			<!-- <div class="row"> -->
				<!-- <div class="col-sm-3">
					<label>Salary Type</label>
					<select name="salary_type" class="form-control">
						<option value="1">Monthly</option>
						<option value="2">Yearly</option>
						<option value="3">Daily</option>
					</select>
				</div> -->

				<div class="col-sm-3">
					<label>Job Type</label>
					<select name="job_type" class="form-control">
						<option value="1">Internship</option>
						<option value="2">Fresher</option>
						<option value="3">Experienced</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Work Type</label>
					<select name="work_type" class="form-control">
						<option value="1">Part Time</option>
						<option value="2">Full Time</option>
					</select>
				</div>
				

				<!-- <div class="col-sm-3">
					<label>Expired On</label>
					<input type="date" name="expires_on" class="form-control">
				</div> -->
			</div>
			<br>
			<!-- <div class="row">
				<div class="col-sm-3">
					<label>No Of Positions</label>
					<input type="number" name="no_of_position" class="form-control" disabled>
				</div> -->
				<div class="row">
				<div class="col-sm-3">
					<label>Urgent Hiring</label>
					<select name="urgent_hiring" class="form-control">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>

				<!-- <div class="col-sm-3">
					<label>Status</label>
					<select name="status" class="form-control">
						<option value="1">Open</option>
						<option value="0">Closed</option>
					</select>
				</div> -->
				<div class="row">
				<div class="col-sm-12">
					<label>Daily Job</label>
					<textarea type="text" name="daily_job" class="form-control" rows="8">
</textarea>
				</div>
</div>
<div class="row">
				<div class="col-sm-12">
					<label>Team Engagement</label>
					<textarea type="text" name="team_engagement" class="form-control" rows="8">
</textarea>
				</div>
</div>
<div class="row">
				<div class="col-sm-12">
					<label>Reporting</label>
					<textarea type="text" name="reporting" class="form-control" rows="8">
</textarea>
				</div>
</div>
			</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label>profile</label>
					<textarea type="text" name="profile" class="form-control" rows="8" >
					</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<label>Responsibilities</label>
					<textarea type="text" name="Responsibilities" class="form-control" rows="8" >
					</textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label>Summery</label>
					<textarea class="form-control" name="summery" rows="8"></textarea>
				</div>
				
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label>Description</label>
					<textarea class="form-control" name="description" rows="8"></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" type="submit" name="savepublish" value="1" style="float: right">Add Job Description</button>
					<button class="btn btn-warning" type="submit" name="savedraft" value="1" style="float: right;margin-right: 6px;margin-bottom: 15px;" >Save Draft</button>
				</div>
			</div>
		</form>
	</div>
</div>


@endsection