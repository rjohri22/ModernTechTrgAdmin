@extends('admin.layout.master')
@section('content')

<div class="card container mt-2" style="background: white">
	<br>

	<div class="card-header">
		<h3>Add Job Description</h3>
	</div>
	<div class="card-body">
		
		<form action="{{url('admin/job_applications/store_application')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<label>Title</label>
					<input type="text" name="title" class="form-control">
				</div>
				<div class="col-sm-3">
					<label>Company</label>
					<select name="company" class="form-control">
						<option value="">Select Company</option>
						@foreach($companies as $company)
							<option value="{{$company->id}}">{{$company->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-3">
					<label>Min Salary</label>
					<input type="number" name="min_salary" class="form-control">
				</div>
				<div class="col-sm-3">
					<label>Max Salary</label>
					<input type="number" name="max_salary" class="form-control">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					<label>Salary Type</label>
					<select name="salary_type" class="form-control">
						<option value="1">Monthly</option>
						<option value="2">Yearly</option>
						<option value="3">Daily</option>
					</select>
				</div>

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

				<div class="col-sm-3">
					<label>Expired On</label>
					<input type="date" name="expires_on" class="form-control">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					<label>Head Count</label>
					<input type="number" name="no_of_position" class="form-control">
				</div>

				<div class="col-sm-3">
					<label>Urgent Hiring</label>
					<select name="urgent_hiring" class="form-control">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>

				<div class="col-sm-3">
					<label>Status</label>
					<select name="status" class="form-control">
						<option value="1">Open</option>
						<option value="0">Closed</option>
					</select>
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
					<button class="btn btn-primary" type="submit" style="float: right">Add Oppertiunity</button>
				</div>
			</div>
		</form>
	</div>
</div>


@endsection