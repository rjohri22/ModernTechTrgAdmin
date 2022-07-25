@extends('admin.layout.master')
@section('content')

<div class="card container mt-2" style="background: white">
	<br>
	<div class="card-header">
		<h3>Job Applications</h3>
	</div>
	<div class="card-body">
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
		      <td>{{$ja->oppertunity}}</td>
		      <td>{{$ja->user_name}}</td>
		      <td>{{$ja->js_interview_datetime}}</td>
		      <td>{{date('Y-m-d',strtotime($ja->company_interview_datetime))}}</td>
		      <td>{{$ja->offer_salary}}</td>
		      <td>{{$ja->joining_date}}</td>
		      <td>
		      	@if($ja->status =='0')
		      		Pending
				@elseif($ja->status =='1')
				    Shortlist
				@elseif($ja->status =='2')
				    Reject
				@elseif($ja->status =='3')
					Interviewed
				@elseif($ja->status =='4')
					Onboarding
				@elseif($ja->status =='5')
				 	Hiring
			 	@else
			 		<i>Not Speicified</i>       
				@endif
		      </td>
		      
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


@endsection