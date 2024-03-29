@extends('admin.layout.master')
@section('content')

<style>
	div.box-body{
		overflow-x: scroll;
	}
</style>
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="card-title d-inline">Employees</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.add_employee')}}" class="btn btn-primary" style="float: right">Add Employee</a>
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
		      <th scope="col">profile</th>
		      <!-- <th scope="col">Country</th> -->
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($employees as $job_seek) 
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td>{{$job_seek->first_name}}</td>
		      <td>{{$job_seek->last_name}}</td>
		      <td>{{$job_seek->email}}</td>
		      <td>{{$job_seek->phone}}</td>
		      <td>{{$job_seek->address_primary}}</td>
		      <td>{{$job_seek->bend_name}}</td>
		      <!-- <td>{{$job_seek->country_name}}</td> -->
		      <td>
		      	<a href="{{route('admin.view_employee',$job_seek->id)}}" class="btn btn-primary btn-sm">View</a>
		      	<a href="{{route('admin.edit_employee',$job_seek->id)}}" class="btn btn-primary btn-sm">Edit</a>
		      	<!-- <a href="{{route('admin.edit_oppertunities',$job_seek->id)}}" class="btn btn-info btn-sm">Edit</a> -->
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Oppertunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_employee',$job_seek->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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


<!-- <div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<a href="{{route('admin.add_employee')}}" class="btn btn-primary" style="float: right">Add Employee</a>
		<h3>Employees</h3>
	</div>
	<div class="box-body">
		
	</div>
</div>
 -->

@endsection