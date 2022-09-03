@extends('admin.layout.master')
@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Employees</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('admin.store_job_seeker') }}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-3">
					<label>First Name</label>
					<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
				</div>
				<div class="col-sm-3">
					<label>Last Name</label>
					<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
				</div>
				<div class="col-sm-3">
					<label>Email</label>
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
				</div>
				<div class="col-sm-3">
					<label>Phone</label>
					<input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<label>Address Primary</label>
					<input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address_1" value="{{ old('address') }}" required autocomplete="address">
				</div>
				<div class="col-sm-6">
					<label>Address Secondary</label>
					<input id="address_2" type="text" class="form-control @error('address') is-invalid @enderror" name="address_2" value="{{ old('address_2') }}" required autocomplete="address">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-4">
					<label>Profile</label>
					<select class="form-control" name="bend" id="bend">
						<option value="">Select Band</option>
						@foreach($bends as $bend)
						<option value="{{$bend->id}}" data-type="{{$bend->band_type}}">{{$bend->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-4 business_area">
					<label>Business</label>
					<select class="form-control" name="business" id="bend">
						<option value="">Select Business</option>
						@foreach($business as $b)
						<option value="{{$b->id}}">{{$b->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-4 country_area">
					<label>Countries</label>
					<select class="form-control" name="country" id="bend">
						<option value="">Select Country</option>
						@foreach($countries as $c)
						<option value="{{$c->id}}">{{$c->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-3">
					<label>Password</label>
					 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
				</div>
				<div class="col-sm-3">
					<label>Confirm Password</label>
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
				</div>
			</div>
		</form>
			</div>
		</div>
	</main>
</div>

<!-- <div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<h3>Add Employees</h3>
	</div>
	<div class="box-body">
		
	</div>
</div> -->


<script type="text/javascript">
	$(document).ready(function(){
		$('.business_area').hide();
		$('.country_area').hide();
		$('#bend').change(function(){
			var bend_type = $('option:selected', this).attr('data-type');
			if(bend_type == 1){
				$('.business_area').show();
				$('.country_area').hide();
			}
			if(bend_type == 2){
				$('.business_area').hide();
				$('.country_area').show();
			}
		});
	});
</script>


@endsection