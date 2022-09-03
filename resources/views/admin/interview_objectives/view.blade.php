@extends('admin.layout.master')
@section('content')

<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">View Interview Objectives</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
			<tr>
				<th style="width: 50%">Title</th>
				<td style="width: 50%">{{$interviewobj->name}}</td>
			</tr>
			
			<tr>
				<th>Round 1</th>
				<td>{{$interviewobj->round_1_passing_marks}}</td>
			</tr>
			<tr>
				<th>Round 2</th>
				<td>{{$interviewobj->round_2_passing_marks}}</td>
			</tr>
			<tr>
				<th>Round 3</th>
				<td>{{$interviewobj->round_3_passing_marks}}</td>
			</tr>
		</table>
		<a href="{{route('admin.interview_objectives')}}" class="btn btn-primary">Back to list</a>
		
			</div>
		</div>
	</main>
</div>

<!-- <div class="box box-primary container mt-2" style="background: white">
	<br>

	<div class="box-header">
		<h3>View Interview Objectives</h3>
	</div>
	<div class="box-body">
		

		
	</div>
</div> -->


@endsection