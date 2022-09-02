@extends('admin.layout.master')
@section('content')


<style>
	div.box-body{
		overflow-x: scroll;
	}
	
	</style>
<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<a href="{{route('admin.busniess_add')}}" class="btn btn-primary" style="float: right;">Add Busniess</a>
		<h3>Business</h3>
	</div>
	<div class="box-body">
		<table id="example" class="table table-striped table-bordered datatable">
		  <thead>
		    <tr>
		      <th scope="col" style="width: 10%">#</th>
		      <th scope="col" style="width: 10%">Name</th>
		      <!-- <th scope="col" style="width: 10%">Country</th>
		      <th scope="col" style="width: 10%">State</th>
		      <th scope="col" style="width: 10%">City</th> -->
		      <th scope="col" style="width: 10%">Address</th>
			  <th scope="col" style="width: 10%">Business URL</th>
			  <th scope="col" style="width: 10%">Business Code</th>
			  <th scope="col" style="width: 10%">Summary</th>
			  <th scope="col" style="width: 10%">Bussines logo</th>
		      <th scope="col" style="width: 10%">Description</th>
		      <!-- <th scope="col" style="width: 10%">Business Type</th> -->
		      <th scope="col" style="width: 10%">Status</th>
		      <th scope="col" style="width: 10%">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($busniess as $b) 
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td class="oppertunity">{{$b->name}}</td>
		      <!-- <td class="oppertunity">{{$b->country}}</td>
		      <td class="oppertunity">{{$b->state}}</td>
		      <td class="oppertunity">{{$b->city}}</td> -->
		      <td class="oppertunity">{{$b->address}}</td>
			  <td class="oppertunity">{{$b->business_url}}</td>
			  <td class="oppertunity">{{$b->business_code}}</td>
			  <td class="oppertunity">{{$b->summary}}</td>
			  <td class="oppertunity"><img src="{{ asset('images/logo/'.$b->business_logo) }}" width="50px" height="50px"/></td>
		      <td class="oppertunity">{{$b->description}}</td>
		      <!-- <td class="oppertunity">{{$b->company_type}}</td> -->
		      <td class="user_name">
		      	@if($b->status == 1)
		      		<span class="label label-success">Active</span>
		      	@elseif($b->status == 0)
		      		<span class="label label-danger">Inactive</span>
		      	@else
		      		<i>Not Specified</i>
	      		@endif
		      </td>
		      <td>
		      	<a href="{{route('admin.busniess_edit',$b->id)}}" class="btn btn-info btn-sm">Edit</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.busniess_delete',$b->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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
