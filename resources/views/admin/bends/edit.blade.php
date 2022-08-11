@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Edit Band</h3>
	</div>
	<div class="box-body">
		<form action="{{route('admin.bend_update',$bend->id)}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="{{$bend->name}}">
				</div>
				@if($special_view == 1)
					<input type="hidden" name="bend_type" id="bend_id" value="{{$bend->band_type}}">
				@else
				<div class="col-sm-4">
					<label>Bend TYpe</label>
					<select class="form-control" name="bend_type" id="bend_type">
						<option value="0" @if ($bend->band_type == 0) selected @endif>All</option>
						<option value="1" @if ($bend->band_type == 1) selected @endif>Business Specific</option>
						<option value="2" @if ($bend->band_type == 2) selected @endif>Country Specific</option>
					</select>
				</div>
				@endif
				@if($special_view == 1)
				<input type="hidden" name="level" id="level" value="{{$bend->level}}">
				@else
				<div class="col-sm-4">
					<label>Level</label>
					<input type="number" name="level" class="form-control" value="{{$bend->level}}">
				</div>
				@endif

			</div>
			<br>
			<div class="row">

				<div class="col-sm-4">
					<label>Report Bend</label>
					<select class="form-control" name="bend_report[]" multiple>
						<option value="">Select Report Bend</option>
						 @foreach($all_bend as $b) 
						 	@if(in_array($b->id, $bend_assign))
								 <option value="{{$b->id}}" selected>{{$b->name}}</option>
						 	@else
								 <option value="{{$b->id}}">{{$b->name}}</option>
						 	@endif
						 @endforeach					
					</select>
				</div>
				
				<div class="col-sm-4">
					<label>Active</label>
					<select class="form-control" name="status">
						<option value="1" @if ($bend->status == 1) selected @endif>Active</option>
						<option value="0" @if ($bend->status == 0) selected @endif>Inactive</option>
					</select>
				</div>

				@if($special_view == 1)
					<input type="hidden" name="special" id="special" value="{{$bend->special}}">
				@else
				<div class="col-sm-4">
					<label>Access For Final Approval</label>
					<select class="form-control" name="special">
						<option value="1" @if ($bend->special == 1) selected @endif>Yes</option>
						<option value="0" @if ($bend->special == 0) selected @endif>No</option>
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
