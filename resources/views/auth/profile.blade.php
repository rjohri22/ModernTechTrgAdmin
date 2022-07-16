@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">{{ __('Profile') }}</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="bs-stepper">
								<div class="bs-stepper-header" role="tablist">
									<div class="step" data-target="#logins-part">
										<button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
											<span class="bs-stepper-circle">1</span>
											<span class="bs-stepper-label">{{('Information')}}</span>
										</button>
									</div>

									<div class="line"></div>
									<div class="step" data-target="#information-part">
										<button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
											<span class="bs-stepper-circle">2</span>
											<span class="bs-stepper-label">{{('Education')}}</span>
										</button>
									</div>
									<div class="line"></div>
									<div class="step" data-target="#work-part">
										<button type="button" class="step-trigger" role="tab" aria-controls="work-part" id="work-part-trigger">
											<span class="bs-stepper-circle">3</span>
											<span class="bs-stepper-label">{{('Work')}}</span>
										</button>
									</div>
								</div>

								<div class="bs-stepper-content">
									<input type="hidden" name="user_id" value="" id="user_id" class="user_id">
									<div id="logins-part" class="content" step='1' role="tabpanel" aria-labelledby="logins-part-trigger">
										<br>
										<form id="step_1_form" enctype="multipart/form-data">
											@csrf
											<strong>User Info</strong>
											<hr>
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<label>{{('Profile Image')}}</label>
														<img src="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg" style="width: 100%">
														<br>
														<br>
														<input type="file" name="profile_url" id="profile_image" class="form-control profile_image">
														<input type="hidden" name="pre_profile_image" id="pre_profile_image">
													</div>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<label>{{('First Name')}}</label>
														<input type="text" name="first_name" id="first_name" class="form-control first_name" value="{{$user->first_name}}">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label>{{('Last Name')}}</label>
														<input type="text" name="last_name" id="last_name" class="form-control last_name" value="{{$user->last_name}}">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label>{{('Email')}}</label>
														<input type="email" name="email" id="email" class="form-control email" value="{{$user->email}}">
													</div>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<label>{{('Phone')}}</label>
														<input type="text" name="phone" id="phone" class="form-control phone" value="{{$user->phone}}">
													</div>
												</div>
											</div>
											<br>
											<strong>Address Info</strong>
											<hr>
											<div class="row">
												<div class="col-sm-3">
													<div class="form-group">
														<label>{{'Country'}}</label>
														<input type="text" name="country" id="country" class="form-control country" value="{{$user->country}}">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>{{'State'}}</label>
														<input type="text" name="state" id="state" class="form-control city" value="{{$user->state}}">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>{{'City'}}</label>
														<input type="text" name="city" id="city" class="form-control city" value="{{$user->city}}">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>{{'Postal Code'}}</label>
														<input type="text" name="postal_code" id="postal_code" class="form-control postal_code" value="{{$user->postal_code}}">
													</div>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-3">
													<div class="form-group">
														<label>{{('Address (Primary)')}}</label>
														<input type="text" name="address_1" id="address_1" class="form-control address_1" value="{{$user->address_primary}}">
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label>{{('Address (Secondary)')}}</label>
														<input type="text" name="address_2" id="address_2" class="form-control address_2" value="{{$user->address_secondary}}">
													</div>
												</div>
											</div>
											<br>
											<strong>Resume Info</strong>
											<hr>
											<div class="row">
												<div class="col-sm-4">
													<label>Resume Type</label>
													<select class="form-control" name="resume_type" id="resume_type">
														<option value="1" {{$user->resume_type == 1 ? 'selected' : '' }}>Private</option>
														<option value="0" {{$user->resume_type == 0 ? 'selected' : '' }}>Public</option>
													</select>
												</div>
												<div class="col-sm-4">
													<label>Desired Jop Title</label>
													<input type="text" name="desired_job_title" id="desired_job_title" class="form-control" value="{{$user->desired_job_title}}">
												</div>
												<div class="col-sm-4">
													<label>Desired Salary</label>
													<input type="text" name="desired_salary" id="desired_salary" class="form-control" value="{{$user->desired_salary}}">
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-4">
													<label>Desired Period</label>
													<select class="form-control" name="desired_period" id="desired_period">
														<option value="monhtly" {{$user->desired_period == 'monthly' ? 'selected' : '' }}>Monthly</option>
														<option value="yearly" {{$user->desired_period == 'yearly' ? 'selected' : '' }}>Yearly</option>
														<option value="daily" {{$user->desired_period == 'daily' ? 'selected' : '' }}>Daily</option>
													</select>
												</div>
												<div class="col-sm-4">
													<label>Desired Job Type</label>
													<select class="form-control" name="desired_jobtype" id="desired_jobtype">
														<option value="full_time" {{$user->desired_jobtype == 'full_time' ? 'selected' : '' }}>Full Time</option>
														<option value="part_time" {{$user->desired_jobtype == 'part_time' ? 'selected' : '' }}>Part Time</option>
													</select>
												</div>
												<div class="col-sm-4">
													<label>Resume Attachment</label>
													<input type="file" name="resume_attachment" id="resume_attachment" class="form-control">
													<input type="hidden" name="pre_resume_attachment" id="pre_resume_attachment" value="{{$user->resume_attachment}}">
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-12">
													<label>{{('Skill')}}</label>
													<input type="text" name="skills" id="skills" class="form-control" value="{{$user->skills}}">
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-12">
													<label>{{('Headline')}}</label>
													<textarea class="form-control" name="headline" id="headline" rows="4">{{$user->headline}}</textarea>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-12">
													<label>{{('Summery')}}</label>
													<textarea class="form-control" name="summery" id="summery" rows="4">{{$user->summery}}</textarea>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-sm-12">
													<label>{{('Additional Information')}}</label>
													<textarea class="form-control" name="addition_information" id="addition_information" rows="4">{{$user->addition_information}}</textarea>
												</div>
											</div>                        
										</form>
										<br>
										<button class="btn btn-primary step_ahead" data-step="1" id="step_1">Save</button>
										<button class="btn btn-secondary" onclick="stepper.next()">Next</button>
									</div>

									<div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
										<div class="row">
											<div class="col-sm-12"> 
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{('Level')}}</label>
															<input type="text" id="edu_level" class="form-control">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{('Institude Name')}}</label>
															<input type="text" id="edu_institude" class="form-control">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{('Field Name')}}</label>
															<input type="text" id="edu_field" class="form-control">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{('Country')}}</label>
															<input type="text" id="edu_country" class="form-control">
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{('State')}}</label>
															<input type="text" id="edu_state" class="form-control">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{('City')}}</label>
															<input type="text" id="edu_city" class="form-control">
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<label>{{('from')}}</label>
															<input type="date" name="edu_start_date" id="education_start_date" class="form-control">
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<label>{{('To')}}</label>
															<input type="date" name="edu_end_date" id="education_end_start" class="form-control">
														</div>
													</div>
													<div class="col-sm-1">
														<button class="btn btn-primary add_education" style="text-align: center; margin-top: 24px" id="educations_add">{{('Add')}}</button>
													</div>
												</div>
												<br>
												<form action="#" method="post" id="education-frm">
													@csrf
													<table class="table table-bordered">
														<thead>
															<tr>
																<th>{{('Level')}}</th>
																<th>{{('Institude Name')}}</th>
																<th>{{('Field Name')}}</th>
																<th>{{('Country')}}</th>
																<th>{{('State')}}</th>
																<th>{{('City')}}</th>
																<th>{{('From ')}}</th>
																<th>{{('To ')}}</th>
																<th>{{('Actions')}}</th>
															</tr>
														</thead>
														<tbody class="education_tbody">
															@foreach($education as $edu)   
																<tr class="row_{{$edu->id}}">
																		<input type="hidden" name="insert_update[]" value="1">
												 						<td><input type="text" class="form-control" name="level[]" value="{{$edu->level}}" readonly/></td>
												 						<td><input type="text" class="form-control" name="institude[]" value="{{$edu->institute_name}}" readonly/></td>
												 						<td><input type="text" class="form-control" name="field[]" value="{{$edu->field_name}}" readonly/></td>
												 						<td><input type="text" class="form-control" name="country[]" value="{{$edu->country}}" readonly/></td>
												 						<td><input type="text" class="form-control" name="state[]" value="{{$edu->state}}" readonly/></td>
												 						<td><input type="text" class="form-control" name="city[]" value="{{$edu->city}}" readonly/></td>
												 						<td><input type="text" class="form-control" name="from[]" value="{{$edu->period_from}}" readonly/></td>
												 						<td><input type="text" class="form-control" name="to[]" value="{{$edu->period_to}}" readonly/></td>
												 						<td><button class="btn btn-danger del-pre" data-id="{{$edu->id}}">X</button></td>
												 					</tr>
																@endforeach 
														</tbody>
													</table>
													<input type="hidden" name="del_id" value="" id="del_ids">
												</form>
											</div>
										</div>
										<button class="btn btn-primary" onclick="stepper.previous()">{{('Previous')}}</button>
										<button class="btn btn-primary" onclick="stepper.next()">{{('Next')}}</button>
										<button class="btn btn-primary" id="save_education">{{('Save And Next')}}</button>
									</div>


									<div id="work-part" class="content" role="tabpanel" aria-labelledby="work-part-trigger">
										<div class="row">
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-5">
														<div class="form-group">
															<label>{{'Title'}}</label>
															<input type="text" id="work_title" class="form-control">

														</div>
													</div>

													<div class="col-sm-3">
														<div class="form-group">
															<label><?php echo ('User.start_date')?></label>
															<input type="date" id="work_start_date" class="form-control">
														</div>
													</div>


													<div class="col-sm-3">
														<div class="form-group">
															<label><?php echo ('User.end_date')?></label>
															<input type="date" id="work_start_date" class="form-control">

														</div>
													</div>
													<div class="col-sm-1">
														<button class="btn btn-primary" style="margin-top: 31px" id="work_add">Add</button>
													</div>
												</div>
												<table class="table table-bordered">
													<thead>
														<tr>
															<th><?php echo ('User.title')?></th>
															<th><?php echo ('User.start_date')?></th>
															<th><?php echo ('User.end_date')?></th>
															<th><?php echo ('User.actions')?></th>
														</tr>
													</thead>
													<tbody class="work_tbody">
													</tbody>
												</table>
											</div>
										</div>
										<button class="btn btn-primary" onclick="stepper.previous()"><?php echo ('User.prevoius')?></button>
										<button type="submit" class="btn btn-primary step_ahead" data-step="4" id="step_4" onclick="stepper.next()"><?php echo ('User.complete')?></button>                            
									</div>
								</div>
							</div>

							<!-- /.card -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		 document.addEventListener('DOMContentLoaded', function () {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    });

		 $(document).ready(function(){
		 		$('#step_1').click(function(e){
		 			e.preventDefault();
		 			$('#step_1_form').submit();
		 		});
		 		$('#step_1_form').submit(function(e){
		 			e.preventDefault();
		 			var formData = new FormData(this);
		 			$.ajax({
		        type:'POST',
		        url: '{{route("store_profile")}}',
		        data:formData,
		        cache:false,
		        contentType: false,
		        processData: false,
		        success:function(data){
		        	var converted = JSON.parse(data);
		        	if(converted.status == '1'){
		        		stepper.next();
		        	}else{
		        		alert('Something Wents Wrong');
		        	}
		        }
		      });
		 			console.log('Submitted');
		 		});

		 		$('#educations_add').click(function(){
		 			var level = $('#edu_level').val();
		 			var institude = $('#edu_institude').val();
		 			var field = $('#edu_field').val();
		 			var country = $('#edu_country').val();
		 			var state = $('#edu_state').val();
		 			var city = $('#edu_city').val();
		 			var from = $('#education_start_date').val();
		 			var to = $('#education_end_start').val();
		 			var html = '';
		 			if(level != '' && institude != '' && field != '' && from != '' && to != ''){
		 				html += `
		 					<tr>
			 					<input type="hidden" name="insert_update[]" value="0">
		 						<td><input type="text" class="form-control" name="level[]" value="${level}" readonly/></td>
		 						<td><input type="text" class="form-control" name="institude[]" value="${institude}" readonly/></td>
		 						<td><input type="text" class="form-control" name="field[]" value="${field}" readonly/></td>
		 						<td><input type="text" class="form-control" name="country[]" value="${country}" readonly/></td>
		 						<td><input type="text" class="form-control" name="state[]" value="${state}" readonly/></td>
		 						<td><input type="text" class="form-control" name="city[]" value="${city}" readonly/></td>
		 						<td><input type="text" class="form-control" name="from[]" value="${from}" readonly/></td>
		 						<td><input type="text" class="form-control" name="to[]" value="${to}" readonly/></td>
		 						<td><button class="btn btn-danger">X</button></td>
		 					</tr>
		 				`;
		 				$('.education_tbody').append(html);
		 			}
		 		});

		 		$('#save_education').click(function(e){
		 			e.preventDefault();
		 			$('#education-frm').submit();
		 		});

		 		$('#education-frm').submit(function(e){
					e.preventDefault();
					var formData = new FormData(this);
					$.ajax({
		        type:'POST',
		        url: '{{route("store_education")}}',
		        data:formData,
		        cache:false,
		        contentType: false,
		        processData: false,
		        success:function(data){
		        	var converted = JSON.parse(data);
		        	if(converted.status == '1'){
		        		stepper.next();
		        	}else{
		        		alert('Something Wents Wrong');
		        	}
		        }
		      });
		 		});

		 		$('.del-pre').click(function(e){
		 			e.preventDefault();
		 			var edu_id = $(this).attr('data-id');
		 			var del_ids = $('#del_ids').val();
		 			var new_del_ids = del_ids+','+edu_id;
		 			$('#del_ids').val(new_del_ids);
		 			$(`.row_${edu_id}`).remove();
		 		})

		 });
	</script>
	@endsection