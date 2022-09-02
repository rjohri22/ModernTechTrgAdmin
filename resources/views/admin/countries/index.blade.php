@extends('admin.layout.master')
@section('content')
<style>
	div.box-body{
		overflow-x: scroll;
	}
	
	</style>

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
  
		<a href="{{route('admin.countries_add')}}" class="btn btn-primary" style="float: right;">Add Countries</a>
		<h3>Countries</h3>
	</div>
	<div class="box-body">
		<table id="example" class="table table-striped table-bordered datatable">
		  <thead>
		    <tr>
		      <th scope="col" style="width: 10%">#</th>
		      <th scope="col" style="width: 40%">Name</th>
		      <th scope="col" style="width: 10%">Status</th>
		      <th scope="col" style="width: 10%">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($countries as $country) 
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td class="oppertunity">{{$country->name}}</td>
		      <td class="user_name">
		      	@if($country->active == 1)
		      		<span class="label label-success">Active</span>
		      	@elseif($country->active == 0)
		      		<span class="label label-danger">Inactive</span>
		      	@else
		      		<i>Not Specified</i>
	      		@endif
		      </td>
		      <td>
           
		      	<a href="{{route('admin.countries_edit',$country->id)}}" class="btn btn-info btn-sm">Edit</a>
                 
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.countries_delete',$country->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
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
