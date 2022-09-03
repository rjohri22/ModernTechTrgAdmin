@extends('admin.layout.master')
@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Edit Question Bank</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.update_question_bank',$question->id)}}" method="post">
					@csrf
					<div class="row">
						<div class="col-sm-6">
							<label>Department</label>
							<select name="department" class="form-control" id="department">
								@foreach($department as $dept)
								<option value="{{$dept->id}}" {{($dept->id == $question->department_id) ? "selected" : "";}}>{{$dept->title}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-6">
							<label>Question type</label>
							<select name="question_type" class="form-control" id="question_type">
								<option value="0" {{($question->question_type == 0) ? "selected" : "";}}>Objective</option>
								<option value="1" {{($question->question_type == 1) ? "selected" : "";}}>Subjective</option>
							</select>
						</div>	
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
							<label>Question</label>
							<textarea class="form-control" name="question" rows="5">{{$question->question}}</textarea>
						</div>	
					</div>
					<br>
					<div class="row">
						<div class="col-sm-3 option_a_area">
							<label>Option A</label>
							<input type="text" name="option_a" class="form-control" value="{{$question->option_a}}">
						</div>
						<div class="col-sm-3 option_b_area">
							<label>Option B</label>
							<input type="text" name="option_b" class="form-control" value="{{$question->option_b}}">
						</div>
						<div class="col-sm-3 option_c_area">
							<label>Option C</label>
							<input type="text" name="option_c" class="form-control" value="{{$question->option_c}}">
						</div>	
						<div class="col-sm-3 option_d_area">
							<label>Option D</label>
							<input type="text" name="option_d" class="form-control" value="{{$question->option_d}}">
						</div>	
					</div>
					<br>
					<div class="row answer_area">
						<div class="col-sm-4">
							<label>Correct Answer</label>
							<select class="form-control correct_ans" name="correct_ans">
								<option value="A" {{($question->correct_ans == "A") ? "selected" : "";}}>A</option>
								<option value="B" {{($question->correct_ans == "B") ? "selected" : "";}}>B</option>
								<option value="C" {{($question->correct_ans == "C") ? "selected" : "";}}>C</option>
								<option value="D" {{($question->correct_ans == "D") ? "selected" : "";}}>D</option>
							</select>
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

<!-- 
<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<h3>Add Question Bank</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#question_type').change(function(){
			var question_type = $(this).val();
			if(question_type == '1'){
				$('.option_b_area').hide();
				$('.option_c_area').hide();
				$('.option_d_area').hide();
				$('.correct_ans').val('A');
				$('.answer_area').hide();
			}else{
				$('.option_b_area').show();
				$('.option_c_area').show();
				$('.option_d_area').show();
				$('.answer_area').show();
			}
		});

		$('#question_type').trigger('change');
	});
</script>
@endsection
