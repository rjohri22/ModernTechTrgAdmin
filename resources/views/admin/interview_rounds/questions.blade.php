@extends('admin.layout.master')
@section('content')

<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="card-title d-inline">Questions</h5>
					</div>
					<div class="col-sm-4">
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-sm">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Round</th>
				      <th scope="col">Department</th>
					  <th scope="col">Question Type</th>
					  <th scope="col">Question</th>
					  <th scope="col">Options</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($questions as $k => $q)
						<tr>
							<td>{{$k+1}}</td>
							<td>{{$q->rname}}</td>
							<td>{{$q->dname}}</td>
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
						</tr>
				  	@endforeach		  	
				  </tbody>
				</table>
			</div>
		</div>
	</main>
</div>
@endsection