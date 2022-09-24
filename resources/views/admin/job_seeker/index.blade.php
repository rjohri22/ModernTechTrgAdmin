@extends('admin.layout.master')
@section('content')

<style>
	div.box-body{
		overflow-x: scroll;
	}
</style>
<form action="{{route('admin.assign_jbs')}}" method="post">
	@csrf
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Job Seeker</h5>
						<button class="btn btn-primary" id="assign_jsu" style="float: right">Assign Job Status Update</button>
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example" class="table table-striped table-bordered datatable">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">First Name</th>
		      <th scope="col">Last Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Phone</th>
		      <th scope="col">Address</th>
		      <th scope="col">Job status</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($job_seeks as $job_seek) 
		    <tr>
		      <th scope="row">
		      	<input type="checkbox" name="jb_id[]" value="{{$job_seek->id}}">
		      </th>
		      <td>{{$job_seek->first_name}}</td>
		      <td>{{$job_seek->last_name}}</td>
		      <td>{{$job_seek->email}}</td>
		      <td>{{$job_seek->phone}}</td>
		      <td>{{$job_seek->address_primary}}</td>
		      <td>{{$job_seek->jbu_name}}</td>
		      <td>
		      	<a href="{{route('admin.view_job_seeker',$job_seek->id)}}" class="btn btn-primary btn-sm">View</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Oppertunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_job_seeker',$job_seek->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
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
	</main>
</div>

<div class="modal fade" id="jsu_modal" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header">
	        <h5 class="modal-title">Assign Employee</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
        	<label>Select Employee</label>
        	<select class="form-control" name="emp_id">
        		@foreach($employeess as $emp)
        			<option value="{{$emp->id}}">{{$emp->name}}</option>
        		@endforeach
        	</select>
	      </div>
	      <div class="modal-footer">
	      	<button type="submit" class="btn btn-primary">Submit</button>
	      </div>

        </div>
    </div>
</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#assign_jsu').click(function(e){
			e.preventDefault();
			$('#jsu_modal').modal('show');
		});
	});
</script>

@endsection