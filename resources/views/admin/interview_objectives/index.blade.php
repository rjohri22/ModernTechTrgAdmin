@extends('admin.layout.master')
@section('content')

<style>
	div.box-body{
		overflow-x: scroll;
	}
	
	</style>
<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<a href="{{route('admin.add_interview_objectives')}}" class="btn btn-primary" style="float: right;">Add Interview Objective</a>
		<h3>Interview Objectives</h3>
	</div>
	<div class="box-body">
		<table id="example" class="table table-striped table-bordered datatable">
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
		  @php
			{{$counter = 1;}}
			@endphp
		    @foreach($interviewobj as $intobj) 
		  		<tr>
				  <th scope="row">{{$counter}}</th>
		  			
				    <td class="">{{$intobj->name}}</td>
					<td class="">{{$intobj->round_1_passing_marks}}</td>
					<td class="">{{$intobj->round_2_passing_marks}}</td>
					<td class="">{{$intobj->round_3_passing_marks}}</td>
		  			<td>
		  				<a href="{{route('admin.view_interview_objectives',$intobj->id)}}" class="btn btn-info btn-sm">View</a>
		  				<a href="{{route('admin.edit_interview_objectives',$intobj->id)}}" class="btn btn-info btn-sm">Edit</a>
		  				<a href="{{route('admin.list_question',['id'=>$intobj->id,'round'=>'1'])}}" class="btn btn-success btn-sm">Questions</a>
				      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Group" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_interview_objectives',$intobj->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
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


@endsection
