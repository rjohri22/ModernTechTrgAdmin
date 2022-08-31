@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<h3>Add Question Bank</h3>
	</div>
	<div class="box-body">
		<form action="{{route('admin.store_question_bank')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-6">
					<label>Department</label>
					<select name="department" class="form-control" id="department">
						@foreach($department as $dept)
							<option value="{{$dept->id}}">{{$dept->title}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-6">
					<label>Question type</label>
					<select name="question_type" class="form-control" id="question_type">
						<option value="0">Objective</option>
						<option value="1">Subjective</option>
					</select>
				</div>	
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<label>Question</label>
					<textarea class="form-control" name="question" rows="5"></textarea>
				</div>	
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3 option_a_area">
					<label>Option A</label>
					<input type="text" name="option_a" class="form-control">
				</div>
				<div class="col-sm-3 option_b_area">
					<label>Option B</label>
					<input type="text" name="option_b" class="form-control">
				</div>
				<div class="col-sm-3 option_c_area">
					<label>Option C</label>
					<input type="text" name="option_c" class="form-control">
				</div>	
				<div class="col-sm-3 option_d_area">
					<label>Option D</label>
					<input type="text" name="option_d" class="form-control">
				</div>	
			</div>
			<br>
			<div class="row answer_area">
				<div class="col-sm-4">
					<label>Correct Answer</label>
					<select class="form-control correct_ans" name="correct_ans">
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
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
	});
</script>
@endsection
