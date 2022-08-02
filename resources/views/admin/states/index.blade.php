@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<a href="{{route('admin.states_add')}}" class="btn btn-primary" style="float: right;">Add State</a>
		<h3>States</h3>
	</div>
	<div class="box-body">
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col" style="width: 10%">#</th>
		      <th scope="col" style="width: 40%">Name</th>
		      <th scope="col" style="width: 30%">Country</th>
		      <th scope="col" style="width: 10%">Status</th>
		      <th scope="col" style="width: 10%">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($states as $state) 
		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td class="oppertunity">{{$state->name}}</td>
		      <td class="oppertunity">{{$state->country_name}}</td>
		      <td class="user_name">
		      	@if($state->status == 1)
		      		<span class="label label-success">Active</span>
		      	@elseif($state->status == 0)
		      		<span class="label label-danger">Inactive</span>
		      	@else
		      		<i>Not Specified</i>
	      		@endif
		      </td>
		      <td>
		      	<a href="{{route('admin.states_edit',$state->id)}}" class="btn btn-info btn-sm">Edit</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.states_delete',$state->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
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
