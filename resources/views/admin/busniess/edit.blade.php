@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Edit Business</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.busniess_update',$busniess->id)}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-sm-4">
							<label>Title</label>
							<input type="text" name="title" class="form-control" value="{{$busniess->name}}" >
						</div>
				<!-- <div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country" id="country">
						@foreach ($countries as $country)
						<option value="{{ $country->id }}" @if ($country->id == $busniess->country) selected @endif >{{ $country->name }}</option>
						@endforeach
					</select>
				</div> -->
				<!-- <div class="col-sm-4">
					<label>State</label>
					<select class="form-control" name="state" id="state">
					</select>
				</div> -->
				<!-- <div class="col-sm-4">
					<label>City</label>
					<select class="form-control" name="city" id="cities" >
					</select>
				</div> -->
				<div class="col-sm-4">
					<label>Address</label>
					<input type="text" name="address" class="form-control" value="{{$busniess->address}}" >
				</div>
				<div class="col-sm-4">
					<label>Bussiness Logo</label>
					<input type="file" name="business_logo"  id="business_logo" class="form-control" value="{{$busniess->business_logo}}">
					<img src="  {{ asset('public/images/logo/'.$busniess->business_logo) }}" width="50px" height="50px"/>
				</div>

				<div class="row">
					<div class="col-sm-6 text-center">
						<button class="btn btn-success btn-md upload-image" style="margin-top:2%">Cropping Image</button>
						<br>
						<br>
						<br>
						<div id="upload-demo"></div>
					</div>

					<div class="col-sm-6">
						<br>
						<br>
						<br>
						<br>
						<div id="preview-crop-image" style="background:#9d9d9d;width:200px;height:200px;border: 1px solid;" ></div>
					</div>
				</div>

				<!-- <div class="col-sm-4">
					<label>Bussiness Logo</label>
					<input type="file" name="business_logo" class="form-control" value="{{$busniess->business_url}}">
				</div> -->
				<div class="col-sm-4">
					<label>Business URL</label>
					<input type="text" name="business_url" class="form-control" value="{{$busniess->business_url}}">
				</div>
				
				<!-- <div class="col-sm-4">
					<label>Decription</label>
					<textarea type="textarea" name="address" class="form-control">
					</textarea>	
				</div> -->
				<div class="col-sm-4">
					<label>Active</label>
					<select class="form-control" name="status">
						<option value="1" @if ($busniess->status == 1) selected @endif >Active</option>
						<option value="0" @if ($busniess->status == 0) selected @endif >Inactive</option>
					</select>
				</div>
				<div class="col-sm-12">
					<label>Summary</label>
					<textarea name="Summary" class="form-control" rows="5">{{$busniess->summary}}</textarea>
				</div>
			</div>
			<br>
			<div class=row>
				<div class="col-sm-12">
					<label>Description</label>
					<textarea class="form-control" name="description" rows="5">{{$busniess->description}}</textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="hidden" name="edit_img_name" id="edit_img_name"/>
					<button class="btn btn-primary" type="submit" style="float: right">Save</button>
				</div>
			</div>
			<br>
		</form>
	</div>
</div>
</main>
</div>




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
					$('#state').val({{$busniess->state}});
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
					$('#cities').val({{$busniess->city}});
				}
			});

		}
	});		
</script>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var resize = $('#upload-demo').croppie({
		enableExif: true,
		enableOrientation: true,    
    viewport: { // Default { width: 100, height: 100, type: 'square' } 
    width: 150,
    height: 150,
        type: 'square' //square
    },
    boundary: {
    	width: 200,
    	height: 200
    }
});
	$('#business_logo').on('change', function () { 
		var reader = new FileReader();
		reader.onload = function (e) {
			resize.croppie('bind',{
				url: e.target.result
			}).then(function(){
				console.log('jQuery bind complete');
			});
		}
		reader.readAsDataURL(this.files[0]);
	});
	$('.upload-image').on('click', function (ev) {
		ev.preventDefault();
		resize.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (img) {
			$.ajax({
				url: "{{route('admin.crop')}}",
				type: "POST",
				data: {"business_logo":img},
				success: function (data) {
					var converted = JSON.parse(data);
					console.log(converted.business_logo);

					$('#edit_img_name').val(converted.business_logo);
					html = '<img src="' + img + '" style="position:relative;top:15%;left:10%;text-align:center;"/>';
					$("#preview-crop-image").html(html);
				}
			});
		});
	});





// $('.upload-image').on('click', function (ev) {
//             ev.preventDefault();
//             // var no = $(this).attr('data-no');
//              var image_1 = $(#business_logo).val();
//             $image_crop.croppie('result', {
//               type: 'canvas',
//               size: 'viewport'
//             }).then(function (response) {
//               if(image_1 != ''){
//                 $.ajax({
//                   url: "{{route('admin.crop')}}",
//                   type: "POST",
//                   data: {"business_logo":response},
//                   success: function (data) {
//                     var converted = JSON.parse(data);
//                     console.log(converted.image_name);

//                     html = '<img src="' + response + '" />';

//                   }
//                 });
//               }else{
//                 alert('Image Is Required');
//               }
//             });
//           }); 



</script>
@endsection
