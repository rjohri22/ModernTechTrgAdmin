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
						<h5 class="card-title d-inline">Business Locations</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.business_location_add')}}" class="btn btn-primary" style="float: right;">Add Location</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example" class="table table-striped table-bordered datatable">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Business</th>
				      <th scope="col">Country</th>
				      <th scope="col">State</th>
				      <th scope="col">City</th>
					  <th scope="col">Status</th>
				      <th scope="col">Actions</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@php
					{{$counter = 1;}}
					@endphp
				    @foreach($business_location as $b) 
				    <tr>
				      <th scope="row">{{$counter}}</th>
				      <td class="oppertunity">{{$b->company_name}}</td>
				      <td class="oppertunity">{{$b->country_name}}</td>
				      <td class="oppertunity">{{$b->state_name}}</td>
				      <td class="oppertunity">{{$b->city_name}}</td>
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
				      	<a href="{{route('admin.business_location_edit',$b->id)}}" class="btn btn-info btn-sm">Edit</a>
				      	<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Oppertunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.business_location_delete',$b->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>

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
		<a href="{{route('admin.business_location_add')}}" class="btn btn-primary" style="float: right;">Add Location</a>
		<h3>Business Location</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->


@endsection
