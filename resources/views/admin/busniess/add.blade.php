@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Add Business</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.busniess_store')}}" enctype="multipart/form-data" method="post">
					@csrf
					<div class="row">
						<div class="col-sm-4">
							<label>Title</label>
							<input type="text" name="title" class="form-control">
						</div>
				<!-- <div class="col-sm-4">
					<label>Country</label>
					<select class="form-control" name="country" id="country">
						@foreach ($countries as $country)
						<option value="{{ $country->id }}">{{ $country->name }}</option>

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
					<input type="text" name="address" class="form-control">
				</div>

				<div class="col-sm-4">
					<label>Bussiness Logo</label>
					<input type="file" name="business_logo" id="business_logo" class="form-control">
					
				</div>
				<div class="row">
					<div class="col-sm-6 text-center">
						<button class="btn btn-success btn-md upload-image" style="margin-top:2%">Cropping Image</button>
						<br>
						<br>
						<div id="upload-demo"></div>
					</div>

					<div class="col-sm-6">
						<br>
						<br>
						<br>
						<div id="preview-crop-image" style="background:#9d9d9d;width:200px;height:200px;border: 1px solid;" ></div>
					</div>
				</div>
				<div class="col-sm-4">
					<label>Business URL</label>
					<input type="text" name="business_url" class="form-control">
				</div>
				
				<!-- <div class="col-sm-4">
					<label>Decription</label>
					<textarea type="textarea" name="address" class="form-control">
					</textarea>	
				</div> -->
				<div class="col-sm-4">
					<label>Active</label>
					<select class="form-control" name="status">
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</div>
				<div class="col-sm-12">
					<label>Summary</label>
					<textarea name="Summary" class="form-control">
					</textarea>
				</div>
			</div>
			<br>
			<div class=row>
				<div class="col-sm-12">
					<label>Description</label>
					<textarea class="form-control" name="description" rows="5"></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-sm-12">
					<input type="hidden" name="org_img_name" id="org_img_name"/>
					<button class="btn btn-primary" type="submit" style="float: right">Save</button>
				</div>
			</div>
			<br>
		</form>
	</div>
</div>
</main>
</div>


<!-- <div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3>Add Busniess</h3>
	</div>
	<div class="box-body">
	
		
		
	</div>
</div> -->



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
					$('#org_img_name').val(converted.business_logo);
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
