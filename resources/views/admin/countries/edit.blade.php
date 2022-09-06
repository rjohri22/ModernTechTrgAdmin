@extends('admin.layout.master')
@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Edit Country</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.countries_update',$countries->id)}}" method="post">
					@csrf
					<div class="row">
						<div class="col-sm-4">
							<label>Name</label>
							<input type="text" name="name" class="form-control" value="{{$countries->name}}" >
						</div>
						<div class="col-sm-4">
							<label>Code</label>
							<input type="text" name="code" class="form-control" value="{{$countries->code}}">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<label>Statue</label>
							<select class="form-control" name="active">
								<option value="1" @if ($countries->status == 1) selected @endif >Active</option>
								<option value="0" @if ($countries->status == 0) selected @endif >Inactive</option>
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
							<button class="btn btn-primary" type="submit" style="float: right">Save</button>
						</div>
					</div>
					<br>
				</form>
			</div>
		</div>
	</main>
</div>

<!-- 
<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit Country</h3>
	</div>
	<div class="box-body">
	
	</div>
</div> -->


@endsection