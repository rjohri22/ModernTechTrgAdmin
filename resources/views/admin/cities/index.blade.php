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
						<h5 class="card-title d-inline">Cities</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.cities_add')}}" class="btn btn-primary" style="float: right;">Add City</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example" class="table table-striped table-bordered datatable">
					<thead>
						<tr>
							<th scope="col" style="width: 10%">#</th>
							<th scope="col" style="width: 30%">Name</th>
							<th scope="col" style="width: 20%">State</th>
							<th scope="col" style="width: 20%">Country</th>
							<th scope="col" style="width: 10%">Status</th>
							<th scope="col" style="width: 10%">Actions</th>
						</tr>
					</thead>
					<tbody>
						@php
						{{$counter = 1;}}
						@endphp
						@foreach($cities as $city) 
						<tr>
							<th scope="row">{{$counter}}</th>
							<td class="oppertunity">{{$city->name}}</td>
							<td class="oppertunity">{{$city->state_name}}</td>
							<td class="oppertunity">{{$city->country_name}}</td>
							<td class="user_name">
								@if($city->status == 1)
								<span class="label label-success">Active</span>
								@elseif($city->status == 0)
								<span class="label label-danger">Inactive</span>
								@else
								<i>Not Specified</i>
								@endif
							</td>
							<td>
								<a href="{{route('admin.cities_edit',$city->id)}}" class="btn btn-info btn-sm">Edit</a>
								<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete City" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.cities_delete',$city->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
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
		<a href="{{route('admin.cities_add')}}" class="btn btn-primary" style="float: right;">Add City</a>
		<h3>Cities</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->

@endsection
