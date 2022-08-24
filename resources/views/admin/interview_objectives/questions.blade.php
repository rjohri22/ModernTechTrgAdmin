@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<h3>Add Interview Objectives</h3>
	</div>
	<div class="box-body">
		<form action="{{route('admin.store_interview_question',$interview_id)}}" method="post">
			@csrf

            <div class="row">
           
					<!-- <label></label> -->
					<input type="hidden" name="interview_id" class="form-control" value="{{$interview_id}}">
                    
			

            <div class="col-sm-3">
					<label>Round#</label>
					<select name="round_no" class="form-control">
						<option value="1">1</option>
						<option value="2">2</option>
                        <option value="3">3</option>
					</select>
				</div>
</div>
			<div class="row">
				<div class="col-sm-6">
					<label>Question</label>
					<input type="text" name="question" class="form-control">
                    
				</div>	
                
			</div>
            
			<br>
			<div class="row">
				<div class="col-sm-4">
					<label>Option A</label>
					<input type="text" name="option_a" class="form-control">
				</div>
				<div class="col-sm-4">
					<label>Option B</label>
					<input type="text" name="option_b" class="form-control">
				</div>
				<div class="col-sm-4">
					<label>Option C</label>
					<input type="text" name="option_c" class="form-control">
				</div>	
                <div class="col-sm-4">
					<label>Option D</label>
					<input type="text" name="option_d" class="form-control">
				</div>	
                
			</div>
            <div class="row">
            <div class="col-sm-3">
					<label>Correct Answers</label>
					<select name="correct_answer" class="form-control">
						<option value="A">A</option>
						<option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
					</select>
				</div>
                <div class="col-sm-2">
					<label>Marks</label>
					<input type="text" name="marks" class="form-control">
				</div>	
            </div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="submit" name="add_objective" value="save" class="btn btn-primary">
                    <a href="{{route('admin.list_question',['id'=>$interview_id,'round'=>'1'])}}" class="btn btn-info">list</a>
				</div>
			</div>
			
		</form>
	</div>
</div>
@endsection
