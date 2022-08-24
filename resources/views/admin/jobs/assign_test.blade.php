<div class="modal-dialog">
	<form action="{{route('admin.job_approved_hr',$job_id)}}" method="">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Add Interview Objectives</h4>
		</div>
		<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<label>Country</label>
						<select class="form-control" name="interview_id" id="interview_id">
							@foreach($objectives as $o) 
							<option value="{{$o->id}}">{{$o->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Round 1 Questions</label>
						<input type="text" name="round_1" class="form-control">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Round 2 Questions</label>
						<input type="text" name="round_2" class="form-control">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Round 3 Questions</label>
						<input type="text" name="round_3" class="form-control">
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