@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Edit Interview Objectives</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.update_interview_objectives',$interviewobj->id)}}" method="post">
					@csrf
					<div class="row">
						<div class="col-sm-4">
							<label>Name</label>
							<input type="text" name="title" class="form-control" value="{{$interviewobj->name}}" >
						</div>
						
						<div class="col-sm-4">
							<label>Round 1</label>
							<input type="text" name="round_1_mark" class="form-control" value="{{$interviewobj->round_1_passing_marks}}" >
						</div>
						<div class="col-sm-4">
							<label>round 2</label>
							<input type="text" name="round_2_mark" class="form-control" value="{{$interviewobj->round_2_passing_marks}}">
							
						</div>
						<div class="col-sm-4">
							<label>round 3</label>
							<input type="text" name="round_3_mark" class="form-control" value="{{$interviewobj->round_3_passing_marks}}">
							
						</div>
						
						
						
						
						<br>
						<div class="row">
							<div class="col-sm-12">
								<button class="btn btn-primary" type="submit" style="float: right">Edit</button>
							</div>
						</div>
						<br>
					</form>

				</div>
			</div>
		</main>
	</div>


<!-- 
<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit Interview Objectives</h3>
	</div>
	<div class="box-body">
		
		
	</div>
</div> -->


@endsection
@section('footer')
<script>
	
</script>
@endsection
