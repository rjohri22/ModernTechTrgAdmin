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
						<h5 class="card-title d-inline">Interview Objectives</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.add_interview_objectives')}}" class="btn btn-primary" style="float: right;">Add Interview Objective</a>
					</div>
				</div>
			</div>
			<div class="card-body">
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
								<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Group" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_interview_objectives',$intobj->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
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
		<a href="{{route('admin.add_interview_objectives')}}" class="btn btn-primary" style="float: right;">Add Interview Objective</a>
		<h3>Interview Objectives</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->


@endsection
