@extends('admin.layout.master')
@section('content')

<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="card-title d-inline">Question Banks</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.add_question_bank')}}" class="btn btn-primary" style="float: right;">Add Question</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-sm">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Department</th>
					  <th scope="col">Question Type</th>
					  <th scope="col">Question</th>
					  <th scope="col">Options</th>
				      <th scope="col">Actions</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($questions as $k => $q)
						<tr>
							<td>{{$k+1}}</td>
							<td>{{$q->title}}</td>
							<td>{{($q->question_type == 1) ? "Subjective" : "Objective" }}</td>
							<td>{{$q->question}}</td>
							<td>
								<ol type="A">
									@if($q->question_type == 1)
									<li>{{$q->option_a}}</li>
									@else
									<li {{($q->correct_answer == 'A') ? "class=bg-danger" : ""}}>{{$q->option_a}}</li>
									<li {{($q->correct_answer == 'B') ? "class=bg-danger" : ""}}>{{$q->option_b}}</li>
									<li {{($q->correct_answer == 'C') ? "class=bg-danger" : ""}}>{{$q->option_c}}</li>
									<li {{($q->correct_answer == 'D') ? "class=bg-danger" : ""}}>{{$q->option_d}}</li>
									@endif
								</ol>
							</td>
							<td>
								<a href="{{route('admin.edit_question_bank',$q->id)}}" class="btn btn-info btn-xs">Edit</a>
								<button type="button" class="btn btn-xs btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Opportunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_question_bank',$q->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
							</td>
						</tr>
				  	@endforeach		  	
				  </tbody>
				</table>
			</div>
		</div>
	</main>
</div>

<!-- <div class="box box-primary container mt-2" style="background: white">
	<br>
	<div class="box-header with-border">
		<a href="{{route('admin.add_question_bank')}}" class="btn btn-primary" style="float: right;">Add Question</a>
		<h3>Question Banks</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->


@endsection