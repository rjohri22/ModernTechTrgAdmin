@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<a href="{{route('admin.question_interview_objectives',$interview_id)}}" class="btn btn-primary" style="float: right;">Add questions</a>
		<h3>Questions</h3>
		
		
		<a href="{{route('admin.list_question',['id'=>$interview_id,'round'=>'1'])}}" class="btn btn-info btn-sm">Round 1</a>
		<a href="{{route('admin.list_question',['id'=>$interview_id,'round'=>'2'])}}" class="btn btn-info btn-sm">Round 2</a>
		<a href="{{route('admin.list_question',['id'=>$interview_id,'round'=>'3'])}}" class="btn btn-info btn-sm">Round 3</a>
	
	
	</div>
	<div class="box-body">
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col" style="width: 2%">#</th>
              <th scope="col" style="width: 5%">Round No</th>
		      <th scope="col" style="width: 15%">Question</th>
		      <th scope="col" style="width: 10%">Option A</th>
		      <th scope="col" style="width: 10%">Option B</th>
		      <th scope="col" style="width: 10%">Option C</th>
              <th scope="col" style="width: 10%">Option D</th>
              <!-- <th scope="col" style="width: 5%">Marks</th> -->
			  <th scope="col" style="width: 2%">Correct Answers</th>
		      <th scope="col" style="width: 5%">Actions</th>
		    </tr>
		  </thead>
		 
		  <tbody>
		  @php
			{{$counter = 1;}}
			@endphp
		    @foreach($questions as $question) 
		  		<tr>
				  <th scope="row">{{$counter}}</th>
                    <td class="">{{$question->round_no}}</td>
				    <td class="">{{$question->question}}</td>
					<td class="">{{$question->option_a}}</td>
					<td class="">{{$question->option_b}}</td>
					<td class="">{{$question->option_c}}</td>
                    <td class="">{{$question->option_d}}</td>
                    <!-- SS -->
					<td class="">{{$question->correct_answer}}</td>
		  			<td>
		  		
		  			<a href="{{route('admin.edit_question',$question->id)}}" class="btn btn-info btn-sm">Edit</a>
		  				
				      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Group" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_question',$question->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
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
@endsection
