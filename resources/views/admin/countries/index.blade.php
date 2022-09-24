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
						<h5 class="card-title d-inline">Countries</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.countries_add')}}" class="btn btn-primary" style="float: right;">Add Countries</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example" class="table table-striped table-bordered datatable">
				  <thead>
				    <tr>
				      <th scope="col" style="width: 10%">#</th>
				      <th scope="col" style="width: 40%">Name</th>
				      <th scope="col" style="width: 20%">Code</th>
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
				      <td class="">{{$country->name}}</td>
				      <td class="">{{$country->code}}</td>
				      <td class="">
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
		                 
				      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Oppertunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.countries_delete',$country->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
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
  
		<a href="{{route('admin.countries_add')}}" class="btn btn-primary" style="float: right;">Add Countries</a>
		<h3>Countries</h3>
	</div>
	<div class="box-body">
	</div>
</div> -->

@endsection
