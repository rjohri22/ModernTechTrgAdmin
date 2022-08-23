@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<a href="{{route('admin.add_interview_objectives')}}" class="btn btn-primary" style="float: right;">Add Interview Objective</a>
		<h3>Interview Objectives</h3>
	</div>
	<div class="box-body">
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col" style="width: 10%">#</th>
		      <th scope="col" style="width: 20%">Name</th>
		      <th scope="col" style="width: 10%">Round 1 Passing Marks</th>
		      <th scope="col" style="width: 10%">Round 2 Passing Marks</th>
		      <th scope="col" style="width: 10%">Round 3 Passing Marks</th>
		      <th scope="col" style="width: 20%">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  		<tr>
		  			<td>01</td>
		  			<td>Interview For Developer</td>
		  			<td>60</td>
		  			<td>60</td>
		  			<td>60</td>
		  			<td>
		  				<a href="#" class="btn btn-info btn-sm">View</a>
		  				<a href="#" class="btn btn-info btn-sm">Edit</a>
		  				<a href="#" class="btn btn-success btn-sm">Questions</a>
				      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Group" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='#' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
		  			</td>
		  		</tr>
		  </tbody>
		</table>
	</div>
</div>
@endsection
