@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<br>
	<div class="box-header with-border">
		<a href="{{route('admin.add_oppertunities')}}" class="btn btn-primary" style="float: right;">Add Oppertunity</a>
		<h3>Oppertunities</h3>
		<span class="label label-primary">Total Job Applied</span>
      	<span class="label label-warning">Total Shortlisted</span>
      	<span class="label label-info">Total Onboarding</span>
      	<span class="label label-success">Total Hired</span>
	</div>
	<div class="box-body">
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Title</th>
		      <th scope="col">Company</th>
		      <th scope="col">Salary</th>
		      <th scope="col">Salary Type</th>
		      <th scope="col">Work Type</th>
		      <th scope="col">Job Type</th>
		      <th scope="col">Expires On</th>
		      <th scope="col">No Of Position</th>
		      <th scope="col">Urgent Hirign</th>
		      <th scope="col">Summery</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($oppertunities as $oppertunity) 
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td>{{$oppertunity->title}}</td>
		      <td>{{$oppertunity->company_name}}</td>
		      <td>{{($oppertunity->min_salary) ? $oppertunity->min_salary : 0}} To {{($oppertunity->max_salary) ? $oppertunity->max_salary : 0}}</td>
		      <td>
		      	@if($oppertunity->salary_type =='1')
		      		Monthly
				@elseif($oppertunity->salary_type =='2')
				    Yearly
				@elseif($oppertunity->salary_type =='3')
				    Daily
				@else
				 	<i>Not Specified</i>       
				@endif
		      </td>
		      <td>
		      	@if($oppertunity->work_type =='1')
		      		Part Time
				@elseif($oppertunity->work_type =='2')
				    Full Time
				@else
				 	<i>Not Specified</i>       
				@endif
		      </td>
		      <td>
		      	@if($oppertunity->job_type =='1')
		      		Internship
				@elseif($oppertunity->job_type =='2')
				    Fresher
				@elseif($oppertunity->job_type =='3')
				    Experienced
				@else
				 	<i>Not Specified</i>       
				@endif
		      </td>
		      <td>{{$oppertunity->expires_on}}</td>
		      <td>{{$oppertunity->no_of_positions}}</td>
		      <td>{{($oppertunity->urgent_hiring) ? "Yes": " No "}}</td>
		      <td>
		      	<span class="label label-primary">0</span>
		      	<span class="label label-warning">0</span>
		      	<span class="label label-info">0</span>
		      	<span class="label label-success">0</span>
			      
			  </td>
		      <td>
		      	<a href="{{route('admin.view_oppertunities',$oppertunity->id)}}" class="btn btn-primary btn-sm">View</a>
		      	<a href="{{route('admin.edit_oppertunities',$oppertunity->id)}}" class="btn btn-info btn-sm">Edit</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.delete_oppertunity',$oppertunity->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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