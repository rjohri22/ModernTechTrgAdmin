@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Add Bend</h3>
	</div>
	<div class="box-body">
		
		<form action="{{route('admin.bend_store')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Title</label>
					<input type="text" name="title" class="form-control">
				</div>
				@if($special_view == 1)
					<input type="hidden" name="bend_type" id="bend_id" value="2">
				@else
				<div class="col-sm-4">
					<label>Band Type</label>
					<select class="form-control" name="bend_type" id="bend_type">
						<option value="1">Business Specific</option>
						<option value="2">Country Specific</option>
					</select>
				</div>
				@endif
				@if($special_view == 1)
					<input type="hidden" name="level" id="level" value="{{($login_details->level > 0) ? $login_details->level-1 : 0}}">
				@else
				<div class="col-sm-4">
					<label>Level</label>
					<input type="number" name="level" class="form-control">
				</div>
				@endif
			</div>
			<br>
			<div class="row">

				<div class="col-sm-4">
					<label>Report Band</label>
					<select class="form-control" name="bend_report[]" multiple>
						<option value="">Select Report Bend</option>
						 @foreach($bends as $b) 
						 <option value="{{$b->id}}">{{$b->name}}</option>
						 @endforeach					
					</select>
				</div>
				
				<div class="col-sm-4">
					<label>Active</label>
					<select class="form-control" name="status">
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</div>
				@if($special_view == 1)
					<input type="hidden" name="special" id="special" value="0">
				@else
				<div class="col-sm-4">
					<label>Access For Final Approval</label>
					<select class="form-control" name="special">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
				</div>
				@endif
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


@endsection


@section('footer')
<script>
	$(document).ready(function(){
		$('#country').change(function(){
			console.log('change country');
			loadstate();
		});
		loadstate();
		function loadstate(){
			console.log('Load States');
			var id = $('#country').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "{{route('admin.cities_states')}}",
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
				url: "{{route('admin.cities_list')}}",
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
