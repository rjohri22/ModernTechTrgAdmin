@extends('admin.layout.master')
@section('content')
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>
<style>
	div.box-body{
		overflow-x: scroll;
	}
	
	</style>
<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<a href="{{route('admin.add_job_seeker')}}" class="btn btn-primary" style="float: right">Add Employee</a>
		<h3>Employees</h3>
	</div>
	<div class="box-body">
		<table id="example" class="table table-striped table-bordered">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">First Name</th>
		      <th scope="col">Last Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Phone</th>
		      <th scope="col">Address</th>
		      <th scope="col">Band</th>
		      <th scope="col">Country</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($job_seeker as $job_seek) 
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td>{{$job_seek->first_name}}</td>
		      <td>{{$job_seek->last_name}}</td>
		      <td>{{$job_seek->email}}</td>
		      <td>{{$job_seek->phone}}</td>
		      <td>{{$job_seek->address_primary}}</td>
		      <td>{{$job_seek->bend_name}}</td>
		      <td>{{$job_seek->country_name}}</td>
		      <td>
		      	<a href="{{route('admin.view_job_seeker',$job_seek->id)}}" class="btn btn-primary btn-sm">View</a>
		      	<a href="{{route('admin.edit_job_seeker',$job_seek->id)}}" class="btn btn-primary btn-sm">Edit</a>
		      	<!-- <a href="{{route('admin.edit_oppertunities',$job_seek->id)}}" class="btn btn-info btn-sm">Edit</a> -->
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_job_seeker',$job_seek->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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
<script>
	$(document).ready(function () {
    $('#example').DataTable();
});
	</script>


@endsection