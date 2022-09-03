<div class="modal-dialog">
	<form action="{{route('admin.store_approv_hr',$job_id)}}" method="post">
		@csrf
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">HR APPROVAL</h4>
		</div>
		<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<label>Work Type</label>
						<select class="form-control" name="work_type" id="objectives">
							<option value="">Select Objective</option>
							<option value="2">Full Time</option>
							<option value="1">Part Time</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Work Shift</label>
						<select class="form-control" name="work_shift" id="objectives">
							<option value="">Select Shift</option>
							<option value="day">Day</option>
							<option value="night">Night</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Work Style</label>
						<select class="form-control" name="work_style" id="objectives">
							<option value="">Select Shift</option>
							<option value="onsite">Onsite</option>
							<option value="remote">Remote</option>
							<option value="hybrid">Hybrid</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Remarks</label>
						<textarea class="form-control" rows="5" name="hr_remark"></textarea>
					</div>
				</div>
		</div>

		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="save" value="Save">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	</form>
</div>

<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
<script>
$(document).ready(function(){
	
	
$('#round_1').on('keyup', function(e){
	var this_val = parseInt($(this).val());
	var this_attr = parseInt($(this).attr('data-total'));
	if(this_val > this_attr){
     swal.fire(`You cant enter more than ${this_attr} as input in round 1`);
	 $("#round_1").val(this_attr);
	}	
	
});
$('#round_2').on('keyup', function(e){
	var this_val = parseInt($(this).val());
	var this_attr = parseInt($(this).attr('data-total'));
	if(this_val > this_attr){
     swal.fire(`You cant enter more than ${this_attr} as input in round 2`);
	 $("#round_2").val(this_attr);
	}	

	// if(this.value > 30){
 //       swal.fire('You cant enter more than 30 as input in round 2');
	//    $("#round_2").val('30');
	// }
});
$('#round_3').on('keyup', function(e){
	var this_val = parseInt($(this).val());
	var this_attr = parseInt($(this).attr('data-total'));
	if(this_val > this_attr){
     swal.fire(`You cant enter more than ${this_attr} as input in round 3`);
	 $("#round_3").val(this_attr);
	}	
	// if(this.value > 35){
 //       swal.fire('You cant enter more than 35 as input in round 3');
 //       $("#round_3").val('35');
	// }
});



$('#objectives').change(function(){
			console.log('change round numbers');
			loadround();
		});
		loadround();
		function loadround(){
			console.log('Load Rounds');
			var id = $('#objectives').val();
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
					if(data.codestatus){
						var question = data.data;
						$('#round_1').attr('data-total',question.round_1);
						$('#round_2').attr('data-total',question.round_2);
						$('#round_3').attr('data-total',question.round_3);
					}
					// $('#round_1').html(data.html);
					// loadcity();
				}
			});

		}






});
</script> -->