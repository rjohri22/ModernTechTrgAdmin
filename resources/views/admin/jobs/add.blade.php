@extends('admin.layout.master')
@section('content')
<style>
	.sweet-warning{
		background-color: blue;
	}
	</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Add Jobs</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.store_job')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Job Description</label>
					<select class="form-control" name="jd" id="jd">
						@foreach ($job_descrtiption as $jd)
						<option value="{{ $jd->id }}">{{ $jd->title }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-4">
					<label>Company</label>
					<select class="form-control" name="company_id" id="company_id">
						@foreach ($companies as $company)
						<option value="{{ $company->id }}">{{ $company->name }}</option>
						@endforeach
						<option value="2">test</option>
					</select>
				</div>
				<div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country_id" id="country">
						@foreach ($countries as $country)
						<option value="{{ $country->id }}">{{ $country->name }}</option>

						@endforeach
					</select>
				</div>
				<div class="col-sm-4">
					<label>State</label>
					<select class="form-control" name="state_id" id="state">
					</select>
				</div>
				<div class="col-sm-4">
					<label>City</label>
					<select class="form-control" name="city_id" id="cities" >
					</select>
				</div>
				
				<div class="col-sm-4">
					<label>Head Count</label>
					<input type="number" name="no_of_positions" class="form-control">
				</div>
			</div>
			<br>
			@if($bend_details->level > 4)
			<div class="row">
				<div class="col-sm-3">
					<label>Objective</label>
					<select class="form-control" name="objective" id="objectives">
						@foreach($objectives as $o)
						<option value="{{$o->id}}">{{$o->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-3">
					<label>Round 1 Questions</label>
					<input type="number" name="round_1" class="form-control"  id="round_1">
				</div>
				<div class="col-sm-3">
					<label>Round 2 Questions</label>
					<input type="number" name="round_2" class="form-control" id="round_2">
				</div>
				<div class="col-sm-3">
					<label>Round 3 Questions</label>
					<input type="number" name="round_3" class="form-control" id="round_3">
				</div>
			</div>
			<br>
			@endif
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" type="submit" style="float: right">Save</button>
				</div>
			</div>
			<br>
		</form>
	</div>
</div>


@endsection


@section('footer')
<script>
	$(document).ready(function(){


		$('#company_id').change(function(){
			console.log('change company');
			loadcountry();
		});

		loadcountry();
		function loadcountry(){
			console.log('Load country');
			var id = $('#company_id').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.load_business_country')}}",
				type: 'POST',
				data: {id:id},
				success: function(data) {
					$('#country').html(data.html);
					loadstate();
				}
			});

		}





		$('#country').change(function(){
			console.log('change country');
			loadstate();
			
			
		});
		loadstate();
		function loadstate(){
			console.log('Load States');
			var id = $('#company_id').val();
			var id = $('#country').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.load_business_state')}}",
				type: 'POST',
				data: {id:id},
				success: function(data) {
					$('#state').html(data.html);
					loadcity();
				}
			});

		}







		$('#state').change(function(){
			console.log('change state');
			loadcity();
		});
		loadcity();
		function loadcity(){
			console.log('Load City');
			var id = $('#state').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.load_business_city')}}",
				type: 'POST',
				data: {id:id},
				success: function(data) {
					$('#cities').html(data.html);
				}
			});

		}






	});		
</script>
@endsection
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
<script>
$(document).ready(function(){
	
	
$('#round_1').on('keyup', function(e){
	if(this.value > 20){
     swal.fire('You cant enter more than 20 as input in round 1');
	 $("#round_1").val('20');
	}	
	
});
$('#round_2').on('keyup', function(e){
	if(this.value > 30){
       swal.fire('You cant enter more than 30 as input in round 2');
	   $("#round_2").val('30');
	}
});
$('#round_3').on('keyup', function(e){
	if(this.value > 35){
       swal.fire('You cant enter more than 35 as input in round 3');
       $("#round_3").val('35');
	}
});



$('#objectives').change(function(){
			console.log('change round numbers');
			loadround();
			
			
		});
		loadround();
		function loadround(){
			console.log('Load Rounds');
			var id = $('#round_1').val();
			// var id = $('#round_2').val();
			// var id = $('#round_3').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.load_round')}}",
				type: 'POST',
				data: {id:id},
				success: function(data) {
					console.log(data);
					$('#round_1').html(data.html);
					// loadcity();
				}
			});

		}






});
</script>