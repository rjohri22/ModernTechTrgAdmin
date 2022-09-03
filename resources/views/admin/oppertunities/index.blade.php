@extends('admin.layout.master')
@section('content')
@php
use App\Models\Job_applications;
@endphp

<!-- <style>
	div.box-body{
		overflow-x: scroll;
	}
</style> -->

<style type="text/css">

</style>
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="card-title d-inline">Job Descriptions</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.add_oppertunities')}}" class="btn btn-primary" style="float: right;">Add Job Description</a>
					</div>
				</div>
				<div class="row">
				</div>
			</div>
			<div class="card-body">
				<table id="example" class="table datatable">
		  <thead class="">
		    <tr>
		      <th scope="col" style="width: 5%">#</th>
		      <!-- <th scope="col">Title</th> -->
		      <!-- <th scope="col">Company</th> -->
		      <!-- <th scope="col">Salary</th> -->
		      <!-- <th scope="col">Salary Type</th> -->
			  <!-- <th scope="col" style="width: 10%">Daily job</th> -->
			  <!-- <th scope="col">Team Engagement</th> -->
			  <!-- <th scope="col">Reporting</th> -->
			  <th scope="col" class="text-center" style="width: 70%">Profile</th> 
			  <!-- <th scope="col" style="width: 25%">Responsibilities</th> -->
		      <!-- <th scope="col">Work Type</th> -->
		      <!-- <th scope="col">Job Type</th> -->
		      <!-- <th scope="col">Expires On</th> -->
		      <!-- <th scope="col">No Of Position</th> -->
		      <!-- <th scope="col">Urgent Hirign</th> -->
		      <!-- <th scope="col" style="width: 20%">KPI</th> -->
			  <!-- <th scope="col" style="width: 20%">Eligibility Criteria</th> -->
		      <!-- <th scope="col">Status</th> -->
		      <th scope="col" style="width: 10%">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($oppertunities as $oppertunity) 
		   	
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <!-- <td>{{$oppertunity->title}}</td> -->
		      <!-- <td>{{$oppertunity->company_name}}</td> -->
		      <!-- <td>{{($oppertunity->min_salary) ? $oppertunity->min_salary : 0}} To {{($oppertunity->max_salary) ? $oppertunity->max_salary : 0}}</td> -->
		      <!-- <td>
		      	@if($oppertunity->salary_type =='1')
		      		Monthly
				@elseif($oppertunity->salary_type =='2')
				    Yearly
				@elseif($oppertunity->salary_type =='3')
				    Daily
				@else
				 	<i>Not Specified</i>       
				@endif
		      </td> -->
			  <!-- <td>{{substr($oppertunity->daily_job,0,50)}}</td> -->
			  <!-- <td>{{($oppertunity->team_engagement)}}</td> -->
			  <!-- <td>{{($oppertunity->reporting)}}</td> -->
			  <td class="text-center">{{($oppertunity->bend_id)}}</td>
			  <!-- <td>{{substr($oppertunity->Responsibilities,0,50)}}</td> -->
		      <!-- <td>
		      	@if($oppertunity->work_type =='1')
		      		Part Time
				@elseif($oppertunity->work_type =='2')
				    Full Time
				@else
				 	<i>Not Specified</i>       
				@endif
		      </td> -->
		      <!-- <td>
		      	@if($oppertunity->job_type =='1')
		      		Internship
				@elseif($oppertunity->job_type =='2')
				    Fresher
				@elseif($oppertunity->job_type =='3')
				    Experienced
				@else
				 	<i>Not Specified</i>       
				@endif
		      </td> -->
			 
		      <!-- <td>{{date('d-M-Y',strtotime($oppertunity->expires_on))}}</td> -->
		      <!-- <td>{{substr($oppertunity->summery,0,50)}}</td> -->
			  <!-- <td>{{substr($oppertunity->description,0,50)}}</td> -->
		 
		      	<!-- @if($oppertunity->is_draft =='0')
		      		Publish
				@else
					Draft
				@endif -->
		      <!-- </td> -->

		      <td>
				@if($oppertunity->is_draft =='1')
				<a href="{{route('admin.publish_oppertunities',$oppertunity->id)}}" class="btn btn-warning btn-sm">Publish</a>
				@endif
		      	<a href="{{route('admin.view_oppertunities',$oppertunity->id)}}" class="btn btn-primary btn-sm">View</a>
		      	<a href="{{route('admin.edit_oppertunities',$oppertunity->id)}}" class="btn btn-info btn-sm">Edit</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Opportunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_oppertunity',$oppertunity->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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
	</main>
</div>


<!-- <div class="box box-primary container mt-2" style="background: white">
	<br>
	<div class="box-header with-border">
		<a href="{{route('admin.add_oppertunities')}}" class="btn btn-primary" style="float: right;">Add Job Description</a>
		<h3>Job Description</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->




@endsection