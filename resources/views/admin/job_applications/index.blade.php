@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<h3>Job Applications ({{ucwords($application_status)}})</h3>
	</div>
	<div class="box-body">
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Oppertinity</th>
		      <th scope="col">Job Seeker</th>
		      <th scope="col">Dates Select By Job Seeker</th>
		      <th scope="col">Company Interview date</th>
		      <th scope="col">Offer Salary</th>
		      <th scope="col">Joining date</th>
		      <th scope="col">Status</th>
		      @if($application_status == 'interview')
			      <th scope="col">Interview status</th>
		      @endif

		      @if($application_status == 'onboarding')
			      <th scope="col">Offer Letter Status</th>
		      @endif
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($job_applications as $ja) 
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td class="oppertunity">{{$ja->oppertunity}}</td>
		      <td class="user_name">{{$ja->user_name}}</td>
		      <td class="js_interview">{{$ja->js_interview_datetime}}</td>
		      <td class="compnay_interview">{{($ja->company_interview_datetime != null) ? date('Y-m-d',strtotime($ja->company_interview_datetime)) : ""}}</td>
		      <td class="offer_salary">{{$ja->offer_salary}}</td>
		      <td class="joining_date">{{$ja->joining_date}}</td>
		      <td>
		      	<select class="form-control status-change" id="" data-id="{{$ja->id}}">
		      		<option value="0" {{($ja->status ==0) ? "selected" : ""}}>Pending</option>
		      		<option value="1" {{($ja->status ==1) ? "selected" : ""}}>Shortlisted</option>
		      		<option value="2" {{($ja->status ==2) ? "selected" : ""}}>Reject</option>
		      		<option value="3" {{($ja->status ==3) ? "selected" : ""}}>Interview</option>
		      		<option value="4" {{($ja->status ==4) ? "selected" : ""}}>Onboarding</option>
		      		<option value="5" {{($ja->status ==5) ? "selected" : ""}}>Hiring</option>
		      	</select>
		      </td>
		      
		       @if($application_status == 'interview')
		       	<td scope="col">
		       		@if($ja->interview_feebacks != null)
			      		<span class='label label-success'>Taken</span>
					@elseif($ja->interview_feebacks == null)
					    <span class='label label-warning'>Pedning</span>
				 	@else
				 		<i>Not Speicified</i>       
					@endif
		       	</td>
		       @endif

		       @if($application_status == 'onboarding')
			      <td scope="col">
		       		@if($ja->offer_letter_status == 0)
			      		<span class='label label-warning'>Pending</span>
					@elseif($ja->offer_letter_status == 1)
					    <span class='label label-success'>Approved</span>
				    @elseif($ja->offer_letter_status == 2)
					    <span class='label label-danger'>Reject</span>
				 	@else
				 		<i>Not Speicified</i>       
					@endif
		       	</td>
		      @endif
		      <td>
		      	<!-- <a href="{{route('admin.view_job_applications',$ja->id)}}" class="btn btn-primary btn-sm">View</a> -->
		      	<a href="{{route('admin.edit_job_applications',$ja->id)}}" class="btn btn-info btn-sm">Edit</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_application',$ja->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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
			  		location.reload();
			  	}else{
			  		alert('something wents wrongs');
			  		location.reload();
			  	}
			  }
			});
		});
	});
</script>

@endsection