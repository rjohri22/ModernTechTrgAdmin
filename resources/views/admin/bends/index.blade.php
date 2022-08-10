@extends('admin.layout.master')
@section('content')
<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<a href="{{route('admin.bend_add')}}" class="btn btn-primary" style="float: right;">Add Band</a>
		<h3>Bends</h3>
	</div>
	<div class="box-body">
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col" style="width: 10%">#</th>
		      <th scope="col" style="width: 10%">Title</th>
		      <th scope="col" style="width: 10%">Band Type</th>
		      <th scope="col" style="width: 10%">Level</th>
		      <th scope="col" style="width: 10%">Status</th>
		      <th scope="col" style="width: 10%">Report To</th>
		      <th scope="col" style="width: 10%">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($bends as $b)

		    <tr>
		      <th scope="row">{{$counter}}</th>
		      <td class="oppertunity">{{$b->name}}</td>
		      <td class="oppertunity">{{($b->band_type == 1) ? "Business Specific" : "Country Specific"}}</td>
		      <td class="oppertunity">{{$b->level}}</td>
		      <td class="oppertunity">
		      	@if($b->status == 1)
		      		<span class="label label-success">Active</span>
		      	@elseif($b->status == 0)
		      		<span class="label label-danger">Inactive</span>
		      	@else
		      		<i>Not Specified</i>
	      		@endif
		      </td>
		      <td class="oppertunity">{{$b->children}}</td>
		      <td>
		      	<a href="{{route('admin.bend_edit',$b->id)}}" class="btn btn-info btn-sm">Edit</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.bend_delete',$b->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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
