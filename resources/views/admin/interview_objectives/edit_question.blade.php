@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<h3>Edit Interview Objectives</h3>
	</div>
	<div class="box-body">
		<form action="{{route('admin.update_question',$questions->id)}}" method="post">
			@csrf

            <div class="row">
           

            <div class="col-sm-3">
					<label>Round#</label>
					<select name="round_no" class="form-control">
						<option value="1" {{($questions->round_no == "1") ? "Selected" : "";}}>1</option>
						<option value="2" {{($questions->round_no == "2") ? "Selected" : "";}}>2</option>
                        <option value="3" {{($questions->round_no == "3") ? "Selected" : "";}}>3</option>
                       
					</select>
				</div>
</div>
			<div class="row">
				<div class="col-sm-6">
					<label>Question</label>
					<input type="text" name="question" class="form-control" value="{{$questions->question}}">
                    
				</div>	
                
			</div>
            
			<br>
			<div class="row">
				<div class="col-sm-4">
					<label>Option A</label>
					<input type="text" name="option_a" class="form-control" value="{{$questions->option_a}}">
				</div>
				<div class="col-sm-4">
					<label>Option B</label>
					<input type="text" name="option_b" class="form-control" value="{{$questions->option_b}}">
				</div>
				<div class="col-sm-4">
					<label>Option C</label>
					<input type="text" name="option_c" class="form-control" value="{{$questions->option_c}}">
				</div>	
                <div class="col-sm-4">
					<label>Option D</label>
					<input type="text" name="option_d" class="form-control" value="{{$questions->option_d}}">
				</div>	
                
			</div>
            <div class="row">
            <div class="col-sm-3">
					<label>Correct Answers</label>
					<select name="correct_answer" class="form-control">
						<option value="A" {{($questions->correct_answer == "A") ? "Selected" : "";}}>A</option>
						<option value="B" {{($questions->correct_answer == "B") ? "Selected" : "";}}>B</option>
                        <option value="C" {{($questions->correct_answer == "C") ? "Selected" : "";}}>C</option>
                        <option value="D" {{($questions->correct_answer == "D") ? "Selected" : "";}}>D</option>
					</select>
				</div>
                <div class="col-sm-2">
					<label>Marks</label>
					<input type="text" name="marks" class="form-control" value="{{$questions->marks}}">
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
@endsection
