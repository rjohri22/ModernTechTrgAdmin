@extends('admin.layout.master')
@section('content')

<style>
	div.box-body{
		overflow-x: scroll;
	}
	
	</style>


<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="card-title d-inline">Profiles</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.bend_add')}}" class="btn btn-primary" style="float: right;">Add Profile</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example" class="table table-striped table-bordered datatable">
		  <thead>
		    <tr>
		      <th scope="col" style="width: 10%">#</th>
		      <th scope="col" style="width: 10%">Title</th>
		      <th scope="col" style="width: 10%">Profile Type</th>
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
		      <td class="oppertunity">
				@if($b->band_type == 1)
					Business Specific
				@elseif($b->band_type == 2)
					Country Specific
		      	@else
					All
				@endif
			
    		  </td>
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
		      	@if($b->id != 1)
			    <a href="{{route('admin.bend_permission',$b->id)}}" class="btn btn-primary btn-sm">Permission</a>
		      	<a href="{{route('admin.bend_edit',$b->id)}}" class="btn btn-info btn-sm">Edit</a>
		      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Oppertunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.bend_delete',$b->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
		      	@endif

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
	<div class="box-header with-border">
		<a href="{{route('admin.bend_add')}}" class="btn btn-primary" style="float: right;">Add Profile</a>
		<h3>Profiles</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->


@endsection
