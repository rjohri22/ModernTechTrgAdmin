@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<h3>Edit Job Description</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.update_oppertunity',$oppertunity->id)}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="{{$oppertunity->title}}">
				</div>
				<div class="col-sm-3">
					<label>Bend</label>
					<select name="bend_id" class="form-control">
						<option value="">Select Bend</option>
						@foreach($bends as $bend)
							@php
							$selected = ($bend->id == $oppertunity->bend_id) ? 'selected' : '';
							@endphp
							<option value="{{$bend->id}}" {{$selected}}>{{$bend->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-3">
					<label>Min Salary</label>
					<input type="number" name="min_salary" class="form-control" value="{{$oppertunity->min_salary}}">
				</div>
				<div class="col-sm-3">
					<label>Max Salary</label>
					<input type="number" name="max_salary" class="form-control" value="{{$oppertunity->max_salary}}">
				</div>
				<div class="col-sm-3">
					<label>Daily Job</label>
					<input type="text" name="daily_job" class="form-control" value="{{$oppertunity->daily_job}}">
				</div>
				<div class="col-sm-3">
					<label>Team Engagement</label>
					<input type="text" name="team_engagement" class="form-control" value="{{$oppertunity->team_engagement}}">
				</div>
				<div class="col-sm-3">
					<label>Reporting</label>
					<input type="text" name="reporting" class="form-control" value="{{$oppertunity->reporting}}">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					<label>Salary Type</label>
					<select name="salary_type" class="form-control">
						<option value="1" {{($oppertunity->salary_type == 1) ? 'selected' : ''}}>Monthly</option>
						<option value="2" {{($oppertunity->salary_type == 2) ? 'selected' : ''}}>Yearly</option>
						<option value="3" {{($oppertunity->salary_type == 3) ? 'selected' : ''}}>Daily</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Job Type</label>
					<select name="job_type" class="form-control">
						<option value="1" {{($oppertunity->job_type == 1) ? 'selected' : ''}}>Internship</option>
						<option value="2" {{($oppertunity->job_type == 2) ? 'selected' : ''}}>Fresher</option>
						<option value="3" {{($oppertunity->job_type == 3) ? 'selected' : ''}}>Experienced</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Work Type</label>
					<select name="work_type" class="form-control">
						<option value="1" {{($oppertunity->work_type == 1) ? 'selected' : ''}}>Part Time</option>
						<option value="2" {{($oppertunity->work_type == 2) ? 'selected' : ''}}>Full Time</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Expired On</label>
					<input type="date" name="expires_on" class="form-control" value="{{$oppertunity->expires_on}}">
				</div>
			</div>
			<br>
			<!-- <div class="row">
				<div class="col-sm-3">
					<label>No Of Positions</label>
					<input type="number" name="no_of_position" class="form-control" value="{{$oppertunity->no_of_positions}}">
				</div> -->

				<div class="col-sm-3">
					<label>Urgent Hiring</label>
					<select name="urgent_hiring" class="form-control">
						<option value="1" {{($oppertunity->urgent_hiring == 1) ? 'selected' : ''}}>Yes</option>
						<option value="0" {{($oppertunity->urgent_hiring == 0) ? 'selected' : ''}}>No</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Status</label>
					<select name="status" class="form-control">
						<option value="1" {{($oppertunity->status == 1) ? 'selected' : ''}}>Open</option>
						<option value="0" {{($oppertunity->status == 0) ? 'selected' : ''}}>Closed</option>
					</select>
				</div>
				<div class="col-sm-12">
					<label>profile</label>
					<textarea type="text" name="profile" class="form-control" rows="8" value="">{{$oppertunity->profile}}</textarea>
				</div>
				<div class="col-sm-12">
					<label>Responsibilities</label>
					<textarea type="text" name="Responsibilities" class="form-control" rows="8" >{{$oppertunity->Responsibilities}}</textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label>Summery</label>
					<textarea class="form-control" name="summery" rows="8">{{$oppertunity->summery}}</textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label>Description</label>
					<textarea class="form-control" name="description" rows="8">{{$oppertunity->description}}</textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" type="submit" style="float: right">Edit Job Description</button>
				</div>
			</div>
		</form>
	</div>
</div>


@endsection