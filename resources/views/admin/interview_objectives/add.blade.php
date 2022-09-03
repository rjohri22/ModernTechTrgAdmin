@extends('admin.layout.master')
@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Add Interview Objectives</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.store_interview_objectives')}}" method="post">
					@csrf
					<div class="row">
						<div class="col-sm-6">
							<label>Title</label>
							<input type="text" name="title" class="form-control">
						</div>	
					</div>
					<br>
					<div class="row">
						<div class="col-sm-4">
							<label>Round 1 Passing Marks</label>
							<input type="number" name="round_1_mark" class="form-control" value="60" readonly>
						</div>
						<div class="col-sm-4">
							<label>Round 2 Passing Marks</label>
							<input type="number" name="round_2_mark" class="form-control" value="50" readonly>
						</div>
						<div class="col-sm-4">
							<label>Round 3 Passing Marks</label>
							<input type="number" name="round_3_mark" class="form-control" value="40" readonly>
						</div>	
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
							<input type="submit" name="add_objective" value="save" class="btn btn-primary">
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</main>
</div>

<!-- <div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<h3>Add Interview Objectives</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->
@endsection
