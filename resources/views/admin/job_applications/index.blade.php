@extends('admin.layout.master')
@section('content')

<form action="{{route('admin.jobapplications.assign')}}" method="post">
@csrf
<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<h3>Job Applications</h3>
		<button type="button" class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#assign_interviewer' style="float: right">Assign Interviewer</button>
	</div>
	<div class="box-body">
		<table class="table table-sm">
		  <thead>
		    <tr>
				<td></td>
				<th scope="col">#</th>
				<th scope="col">Job</th>
				<th scope="col">Job Seeker</th>
				<th scope="col">Apply Date</th>
				<th scope="col">Interviewer</th>
				<th scope="col">Status</th>
				<th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($applicatoins as $ja) 
		    <tr>
				<td>
					<input type="checkbox" name="ja[]" value="{{$ja->id}}">
				</td>
				<td>{{ $counter }}</td>
				<td>{{ $ja->profile_name }}</td>
				<td>{{ $ja->job_seeker }}</td>
				<td>{{ $ja->created_at->format('d-m-Y') }}</td>
				<td>{{ $ja->interviewer == "" ? "Not Assign" : $ja->interviewer }}</td>
				<td>{{ $ja->status }}</td>
				<td>
					<a href="{{route('admin.jobapplications.view',$ja->id)}}" class="btn btn-primary btn-sm">View</a>
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
<div class="modal fade" id="assign_interviewer" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<div class="modal-header">
	        <h5 class="modal-title">Assign Interviewer</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
        	<label>Select Interviewer</label>
        	<select class="form-control" name="emp_id">
        		@foreach($employeess as $emp)
        			<option value="{{$emp->id}}">{{$emp->name}}</option>
        		@endforeach
        	</select>
	      </div>
	      <div class="modal-footer">
	      	<button type="submit" class="btn btn-primary">Submit</button>
	      </div>

        </div>
    </div>
</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change','.status-change',function(){
			var status = $(this).val();
			var id = $(this).attr('data-id');

			if(status == 4){
				var offer_salary = $(this).parent().parent().find('.offer_salary').text();
				var joining_date = $(this).parent().parent().find('.joining_date').text();
				if(offer_salary == '' || joining_date == ''){
					alert('please Enter Offer Salart And Joining Date');
					$(this).val('3');
					return false;
				}
			}
			$('#overlay').show();
			$.ajax({
			  type: "POST",
			  url: "{{route('admin.change_status')}}",
			  cache: false,
			  data : {
			  	"id" : id,
			  	"status" : status,
			  	"_token":"{{ csrf_token() }}"
			  },
			  dataType: "json",
			  success: function(response){
			  	if(response.status == 1){
			  		$('#overlay').hide();
			  		location.reload();
			  	}else{
			  		alert('something wents wrongs');
			  		$('#overlay').hide();
			  		location.reload();
			  	}
			  }
			});
		});
	});
</script>

@endsection