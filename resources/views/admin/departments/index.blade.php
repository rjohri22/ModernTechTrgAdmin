@extends('admin.layout.master')
@section('content')


<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="card-title d-inline">Departments</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.department_add')}}" class="btn btn-primary" style="float: right;">Add Department</a>
					</div>
				</div>
				<div class="row">
				</div>
			</div>
			<div class="card-body">
				<table class="table table-sm datatable">
		  <thead>
		    <tr>
		      <th scope="col" style="width: 10%">#</th>
		      <th scope="col" style="width: 20%">Title</th>
		      <!-- <th scope="col" style="width: 20%">HOD</th> -->
		      <th scope="col" style="width: 40%">Description</th>
		      <th scope="col" style="width: 20%">Active</th>
		      <th scope="col" style="width: 10%">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($departments as $department) 
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td class="oppertunity">{{$department->title}}</td>
		      <!-- <td class="oppertunity">{{$department->hod_id}}</td> -->
		      <td class="user_name">{{$department->description}}</td>
		      <td class="user_name">
		      	@if($department->active == 1)
		      		<span class="label label-success">Active</span>
		      	@elseif($department->active == 0)
		      		<span class="label label-danger">Inactive</span>
		      	@else
		      		<i>Not Specified</i>
	      		@endif
		      </td>
		      <td>
		      	<a href="{{route('admin.department_edit',$department->id)}}" class="btn btn-info btn-sm">Edit</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Oppertunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.department_delete',$department->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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
	<div class="box-header with-border">
		<a href="{{route('admin.department_add')}}" class="btn btn-primary" style="float: right;">Add Department</a>
		<h3>Department</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->
@endsection
