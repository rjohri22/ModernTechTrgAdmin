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

									<div class="line"></div>
									<div class="step" data-target="#language-part">
										<button type="button" class="step-trigger" role="tab" aria-controls="language-part" id="language-part-trigger">
											<span class="bs-stepper-circle">4</span>
											<span class="bs-stepper-label">{{('Language')}}</span>
										</button>
									</div>

									<div class="line"></div>
									<div class="step" data-target="#certificate-part">
										<button type="button" class="step-trigger" role="tab" aria-controls="certificate-part" id="certificate-part-trigger">
											<span class="bs-stepper-circle">4</span>
											<span class="bs-stepper-label">{{('Certificate')}}</span>
										</button>
									</div>

									<div class="line"></div>
									<div class="step" data-target="#links-part">
										<button type="button" class="step-trigger" role="tab" aria-controls="links-part" id="links-part-trigger">
											<span class="bs-stepper-circle">4</span>
											<span class="bs-stepper-label">{{('Social Link')}}</span>
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
														<div class="image-placeholder">
															<center>
																@if ($user->profile_pic != null)
																<img src="{{URL::asset('public/images/profile/'.$user->profile_pic)}}" style="width: 200px">
																@endif
															</center>
														</div>
														<label>{{('Profile Image')}}</label>
														<input type="file" name="profile_url" id="profile_image" class="form-control profile_image">
														<input type="hidden" name="pre_profile_image" id="pre_profile_image" value="{{$user->profile_pic}}">
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

													<div class="input-group mb-3">
													  <input type="file" name="resume_attachment" id="resume_attachment" class="form-control">
													  <input type="hidden" name="pre_resume_attachment" id="pre_resume_attachment" value="{{$user->resume_attachment}}">
														  <div class="input-group-append resume-placeholder">
														  	@if ($user->resume_attachment != null)
														    <a href="{{URL::asset('public/images/resume/'.$user->resume_attachment)}}" download><span class="input-group-text bg-primary" style="color: white">+</span></a>
														    @endif
														  </div>
													</div>													
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
															@php
															{{$counter = 0;}}
															@endphp

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
												 					@php
																	{{$counter = $edu->id+1;}}
																	@endphp
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
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{'Title'}}</label>
															<input type="text" id="work_title" class="form-control">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{'Company'}}</label>
															<input type="text" id="work_company" class="form-control">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{'From'}}</label>
															<input type="date" id="work_from" class="form-control">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{'To'}}</label>
															<input type="date" id="work_to" class="form-control">
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'Country'}}</label>
															<input type="text" id="work_country" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'State'}}</label>
															<input type="text" id="work_state" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'City'}}</label>
															<input type="text" id="work_city" class="form-control">
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-sm-8">
														<div class="form-group">
															<label>{{'Description'}}</label>
															<input type="text" id="work_description" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<button class="btn btn-primary" style="margin-top: 24px" id="work_add">Add</button>
													</div>
												</div>
												<br>
												<form action="#" method="post" id="work-frm">
													@csrf
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>{{'Title'}}</th>
															<th>{{'Company'}}</th>
															<th>{{'Duration'}}</th>
															<th>{{'Address'}}</th>
															<th>{{'Description'}}</th>
															<th>{{'Actions'}}</th>
														</tr>
													</thead>
													<tbody class="work_tbody">
														@php
															{{$work_counter = 0;}}
															@endphp

															@foreach($works as $work)
															<tr class="work_row_{{$work->id}}">
											 					<input type="hidden" name="insert_update[]" value="1">
										 						<td><input type="text" class="form-control" name="work_title[]" value="{{$work->title}}" readonly/></td>
										 						<td><input type="text" class="form-control" name="work_company[]" value="{{$work->company}}" readonly/></td>
										 						<input type="hidden" name="work_from[]" value="{{$work->period_from}}"/>
										 						<input type="hidden" name="work_to[]" value="{{$work->period_to}}"/>
										 						<td>{{$work->period_from}} - {{$work->period_to}}</td>
										 						<input type="hidden" name="work_country[]" value="{{$work->country}}"/>
										 						<input type="hidden" name="work_state[]" value="{{$work->state}}"/>
										 						<input type="hidden" name="work_city[]" value="{{$work->city}}"/>
										 						<td>{{$work->country}}, {{$work->state}}, {{$work->city}}</td>
										 						<td><input type="text" name="work_description[]" class="form-control" value="{{$work->description}}" readonly/></td>
										 						<td><button class="btn btn-danger work_del-pre" data-id="{{$work->id}}">X</button></td>
										 					</tr>

												 					@php
																	{{$work_counter = $work->id+1;}}
																	@endphp
																@endforeach
													</tbody>
												</table>
												<input type="hidden" name="work_del_id" value="" id="work_del_ids">
											</form>
											</div>
										</div>
										<button class="btn btn-primary" onclick="stepper.previous()">{{'Previous'}}</button>
										<button type="button" class="btn btn-primary" onclick="stepper.next()">{{'Next'}}</button>                            
										<button type="submit" class="btn btn-primary" id="save_work">{{'Save'}}</button>                            
									</div>

									<div id="language-part" class="content" role="tabpanel" aria-labelledby="language-part-trigger">
										<div class="row">
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'Language'}}</label>
															<input type="text" id="language_title" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'Profiency'}}</label>
															<input type="text" id="language_profiency" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<button class="btn btn-primary" style="margin-top: 24px" id="language_add">Add</button>
													</div>
												</div>
												<br>
												<form action="#" method="post" id="language-frm">
													@csrf
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>{{'Title'}}</th>
															<th>{{'Profiecy'}}</th>
															<th>{{'Actions'}}</th>
														</tr>
													</thead>
													<tbody class="language_tbody">
														@php
															{{$language_counter = 0;}}
															@endphp

															@foreach($language as $lang)
															<tr class="language_row_{{$lang->id}}">
											 					<input type="hidden" name="insert_update[]" value="1">
										 						<td><input type="text" class="form-control" name="language_title[]" value="{{$lang->title}}" readonly/></td>
										 						<td><input type="text" class="form-control" name="language_profiency[]" value="{{$lang->proficiency}}" readonly/></td>

										 						<td><button class="btn btn-danger language_del-pre" data-id="{{$lang->id}}">X</button></td>
										 					</tr>

												 					@php
																	{{$language_counter = $lang->id+1;}}
																	@endphp
																@endforeach
													</tbody>
												</table>
												<input type="hidden" name="language_del_id" value="" id="language_del_ids">
											</form>
											</div>
											</div>
											<button class="btn btn-primary" onclick="stepper.previous()">{{'Previous'}}</button>
											<button type="button" class="btn btn-primary" onclick="stepper.next()">{{'Next'}}</button>                            
											<button type="submit" class="btn btn-primary" id="save_language">{{'Save'}}</button>  
										</div>

										<div id="certificate-part" class="content" role="tabpanel" aria-labelledby="certificate-part-trigger">
										<div class="row">
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'Title'}}</label>
															<input type="text" id="certificate_title" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'Institude Name'}}</label>
															<input type="text" id="certificate_institude" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'Description'}}</label>
															<input type="text" id="certificate_description" class="form-control">
														</div>
													</div>
												</div>
												<br>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{'From'}}</label>
															<input type="date" id="certificate_from" class="form-control">
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{'To'}}</label>
															<input type="date" id="certificate_to" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<button class="btn btn-primary" style="margin-top: 24px" id="certificate_add">Add</button>
													</div>
												</div>
												<br>
												<form action="#" method="post" id="certificate-frm">
													@csrf
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>{{'Title'}}</th>
															<th>{{'Institude'}}</th>
															<th>{{'Description'}}</th>
															<th>{{'From'}}</th>
															<th>{{'To'}}</th>
															<th>{{'Actions'}}</th>
														</tr>
													</thead>
													<tbody class="certificate_tbody">
														@php
															{{$certificate_counter = 0;}}
															@endphp

															@foreach($certificate as $cert)
															<tr class="certificate_row_{{$cert->id}}">
											 					<input type="hidden" name="insert_update[]" value="1">
										 						<td><input type="text" class="form-control" name="certificate_title[]" value="{{$cert->title}}" readonly/></td>
										 						<td><input type="text" class="form-control" name="certificate_institude[]" value="{{$cert->institute_name}}" readonly/></td>
										 						<td><input type="text" class="form-control" name="certificate_description[]" value="{{$cert->description}}" readonly/></td>
										 						<td><input type="text" class="form-control" name="certificate_from[]" value="{{$cert->period_from}}" readonly/></td>
										 						<td><input type="text" class="form-control" name="certificate_to[]" value="{{$cert->period_to}}" readonly/></td>

										 						<td><button class="btn btn-danger certificate_del-pre" data-id="{{$cert->id}}">X</button></td>
										 					</tr>

												 					@php
																	{{$certificate_counter = $cert->id+1;}}
																	@endphp
																@endforeach
													</tbody>
												</table>
												<input type="hidden" name="certificate_del_id" value="" id="certificate_del_ids">
											</form>
											</div>
											</div>
											<button class="btn btn-primary" onclick="stepper.previous()">{{'Previous'}}</button>
											<button type="button" class="btn btn-primary" onclick="stepper.next()">{{'Next'}}</button>                            
											<button type="submit" class="btn btn-primary" id="save_certificate">{{'Save'}}</button>  
										</div>

										<div id="links-part" class="content" role="tabpanel" aria-labelledby="links-part-trigger">
										<div class="row">
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'Language'}}</label>
															<input type="text" id="link_title" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label>{{'Link'}}</label>
															<input type="text" id="link_link" class="form-control">
														</div>
													</div>
													<div class="col-sm-4">
														<button class="btn btn-primary" style="margin-top: 24px" id="link_add">Add</button>
													</div>
												</div>
												<br>
												<form action="#" method="post" id="link-frm">
													@csrf
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>{{'Title'}}</th>
															<th>{{'Links'}}</th>
															<th>{{'Actions'}}</th>
														</tr>
													</thead>
													<tbody class="link_tbody">
														@php
															{{$links_counter = 0;}}
															@endphp

															@foreach($links as $link)
															<tr class="link_row_{{$link->id}}">
											 					<input type="hidden" name="insert_update[]" value="1">
										 						<td><input type="text" class="form-control" name="link_title[]" value="{{$link->title}}" readonly/></td>
										 						<td><input type="text" class="form-control" name="link_link[]" value="{{$link->link}}" readonly/></td>
										 						<td><button class="btn btn-danger link_del-pre" data-id="{{$link->id}}">X</button></td>
										 					</tr>

												 					@php
																	{{$links_counter = $link->id+1;}}
																	@endphp
																@endforeach
													</tbody>
												</table>
												<input type="hidden" name="link_del_id" value="" id="link_del_ids">
											</form>
											</div>
											</div>
											<button class="btn btn-primary" onclick="stepper.previous()">{{'Previous'}}</button>
											<button type="button" class="btn btn-primary" onclick="stepper.next()">{{'Next'}}</button>                            
											<button type="submit" class="btn btn-primary" id="save_link">{{'Save'}}</button>  
										</div>

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
		        		var image = converted.data.profile_pic;
		        		var resume = converted.data.resume_attachment;
		        		var html = `<center><img src="{{URL::asset('public/images/profile')}}/${image}" style="width: 200px"></center>`;
		        		
		        		var html2 = `<a href="{{URL::asset('public/images/resume')}}/${resume}" download><span class="input-group-text bg-primary" style="color: white">+</span></a>`;
		        		

		        		$('.image-placeholder').html(html);
		        		$('.resume-placeholder').html(html2);


		        		stepper.next();
		        	}else{
		        		alert('Something Wents Wrong');
		        	}
		        }
		      });
		 			console.log('Submitted');
		 		});

		 		var counter = '{{$counter}}';
		 		var work_counter = '{{$work_counter}}';
		 		var language_counter = '{{$language_counter}}';
		 		var certificate_counter = '{{$certificate_counter}}';
		 		var links_counter = '{{$links_counter}}';


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
		 					<tr class="row_${counter}">
			 					<input type="hidden" name="insert_update[]" value="0">
		 						<td><input type="text" class="form-control" name="level[]" value="${level}" readonly/></td>
		 						<td><input type="text" class="form-control" name="institude[]" value="${institude}" readonly/></td>
		 						<td><input type="text" class="form-control" name="field[]" value="${field}" readonly/></td>
		 						<td><input type="text" class="form-control" name="country[]" value="${country}" readonly/></td>
		 						<td><input type="text" class="form-control" name="state[]" value="${state}" readonly/></td>
		 						<td><input type="text" class="form-control" name="city[]" value="${city}" readonly/></td>
		 						<td><input type="text" class="form-control" name="from[]" value="${from}" readonly/></td>
		 						<td><input type="text" class="form-control" name="to[]" value="${to}" readonly/></td>
		 						<td><button class="btn btn-danger del-post" data-id="${counter}">X</button></td>
		 					</tr>
		 				`;
		 				$('.education_tbody').append(html);
		 				counter++;
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
		 		});


		 		$(document).on('click','.del-post',function(e){
		 			e.preventDefault();
		 			var edu_id = $(this).attr('data-id');
		 			$(`.row_${edu_id}`).remove();
		 		});

		 		$('#work_add').click(function(){
		 			var title = $('#work_title').val();
		 			var company = $('#work_company').val();
		 			var from = $('#work_from').val();
		 			var to = $('#work_to').val();
		 			var country = $('#work_country').val();
		 			var state = $('#work_state').val();
		 			var city = $('#work_city').val();
		 			var description = $('#work_description').val();

		 			var html = '';
		 			if(title != '' && company != '' && from != '' && to != ''){
		 				html += `
		 					<tr class="work_row_${work_counter}">
			 					<input type="hidden" name="insert_update[]" value="0">
		 						<td><input type="text" class="form-control" name="work_title[]" value="${title}" readonly/></td>
		 						<td><input type="text" class="form-control" name="work_company[]" value="${company}" readonly/></td>
		 						<input type="hidden" name="work_from[]" value="${from}"/>
		 						<input type="hidden" name="work_to[]" value="${to}"/>
		 						<td>${from} - ${to}</td>
		 						<input type="hidden" name="work_country[]" value="${country}"/>
		 						<input type="hidden" name="work_state[]" value="${state}"/>
		 						<input type="hidden" name="work_city[]" value="${city}"/>
		 						<td>${country}, ${state}, ${city}</td>
		 						<td><input type="text" name="work_description[]" class="form-control" value="${description}" readonly/></td>
		 						<td><button class="btn btn-danger work_del-post" data-id="${work_counter}">X</button></td>
		 					</tr>
		 				`;
		 				$('.work_tbody').append(html);
		 				work_counter++;
		 			}
		 		});

		 		$('.work_del-pre').click(function(e){
		 			e.preventDefault();
		 			var work_id = $(this).attr('data-id');
		 			var del_ids = $('#work_del_ids').val();
		 			var new_del_ids = del_ids+','+work_id;
		 			$('#work_del_ids').val(new_del_ids);
		 			$(`.work_row_${work_id}`).remove();
		 		});

		 		$(document).on('click','.work_del-post',function(e){
		 			e.preventDefault();
		 			var work_id = $(this).attr('data-id');
		 			$(`.work_row_${work_id}`).remove();
		 		});

		 		$('#save_work').click(function(e){
		 			e.preventDefault();
		 			$('#work-frm').submit();
		 		});

		 		$('#work-frm').submit(function(e){
					e.preventDefault();
					var formData = new FormData(this);
					$.ajax({
		        type:'POST',
		        url: '{{route("store_work")}}',
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

		 		$('#save_language').click(function(e){
		 			e.preventDefault();
		 			$('#language-frm').submit();
		 		});

		 		$('#language-frm').submit(function(e){
					e.preventDefault();
					var formData = new FormData(this);
					$.ajax({
		        type:'POST',
		        url: '{{route("store_language")}}',
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

		 		$('#language_add').click(function(){
		 			var title = $('#language_title').val();
		 			var proficiency = $('#language_profiency').val();
		 			var html = '';
		 			if(title != '' && proficiency != ''){
		 				html += `
		 					<tr class="work_row_${language_counter}">
			 					<input type="hidden" name="insert_update[]" value="0">
		 						<td><input type="text" class="form-control" name="language_title[]" value="${title}" readonly/></td>
		 						<td><input type="text" class="form-control" name="language_profiency[]" value="${proficiency}" readonly/></td>
		 						<td><button class="btn btn-danger language_del-post" data-id="${language_counter}">X</button></td>
		 					</tr>
		 				`;
		 				$('.language_tbody').append(html);
		 				language_counter++;
		 			}
		 		});

		 		$('.language_del-pre').click(function(e){
		 			e.preventDefault();
		 			var lang_id = $(this).attr('data-id');
		 			var del_ids = $('#language_del_ids').val();
		 			var new_del_ids = del_ids+','+lang_id;
		 			$('#language_del_ids').val(new_del_ids);
		 			$(`.language_row_${lang_id}`).remove();
		 		});

		 		$(document).on('click','.language_del-post',function(e){
		 			e.preventDefault();
		 			var lang_id = $(this).attr('data-id');
		 			$(`.language_row_${lang_id}`).remove();
		 		});




		 		$('#save_certificate').click(function(e){
		 			e.preventDefault();
		 			$('#certificate-frm').submit();
		 		});

		 		$('#certificate-frm').submit(function(e){
					e.preventDefault();
					var formData = new FormData(this);
					$.ajax({
		        type:'POST',
		        url: '{{route("store_certificate")}}',
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

		 		$('#certificate_add').click(function(){
		 			var title = $('#certificate_title').val();
		 			var institude = $('#certificate_institude').val();
		 			var description = $('#certificate_description').val();
		 			var from = $('#certificate_from').val();
		 			var to = $('#certificate_to').val();
		 			var html = '';
		 			if(title != '' && institude != '' && from != '' && to != ''){
		 				html += `
		 					<tr class="certificate_row_${certificate_counter}">
			 					<input type="hidden" name="insert_update[]" value="0">
			 					<td><input type="text" class="form-control" name="certificate_title[]" value="${title}" readonly/></td>
		 						<td><input type="text" class="form-control" name="certificate_institude[]" value="${institude}" readonly/></td>
		 						<td><input type="text" class="form-control" name="certificate_description[]" value="${description}" readonly/></td>
		 						<td><input type="text" class="form-control" name="certificate_from[]" value="${from}" readonly/></td>
		 						<td><input type="text" class="form-control" name="certificate_to[]" value="${to}" readonly/></td>
		 						<td><button class="btn btn-danger certificate_del-post" data-id="${certificate_counter}">X</button></td>
		 					</tr>
		 				`;
		 				$('.certificate_tbody').append(html);
		 				certificate_counter++;
		 			}
		 		});

		 		$('.certificate_del-pre').click(function(e){
		 			e.preventDefault();
		 			var cert_id = $(this).attr('data-id');
		 			var del_ids = $('#certificate_del_ids').val();
		 			var new_del_ids = del_ids+','+cert_id;
		 			$('#certificate_del_ids').val(new_del_ids);
		 			$(`.certificate_row_${cert_id}`).remove();
		 		});

		 		$(document).on('click','.certificate_del-post',function(e){
		 			e.preventDefault();
		 			var cert_id = $(this).attr('data-id');
		 			$(`.certificate_row_${cert_id}`).remove();
		 		});



		 		$('#save_link').click(function(e){
		 			e.preventDefault();
		 			$('#link-frm').submit();
		 		});

		 		$('#link-frm').submit(function(e){
					e.preventDefault();
					var formData = new FormData(this);
					$.ajax({
		        type:'POST',
		        url: '{{route("store_links")}}',
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

		 		$('#link_add').click(function(){
		 			var title = $('#link_title').val();
		 			var link = $('#link_link').val();
		 			var html = '';
		 			if(title != '' && link != ''){
		 				html += `
		 					<tr class="link_row_${links_counter}">
			 					<input type="hidden" name="insert_update[]" value="0">
		 						<td><input type="text" class="form-control" name="link_title[]" value="${title}" readonly/></td>
		 						<td><input type="text" class="form-control" name="link_link[]" value="${link}" readonly/></td>
		 						<td><button class="btn btn-danger link_del-post" data-id="${links_counter}">X</button></td>
		 					</tr>
		 				`;
		 				$('.link_tbody').append(html);
		 				links_counter++;
		 			}
		 		});

		 		$('.link_del-pre').click(function(e){
		 			e.preventDefault();
		 			var link_id = $(this).attr('data-id');
		 			var del_ids = $('#link_del_ids').val();
		 			var new_del_ids = del_ids+','+link_id;
		 			$('#link_del_ids').val(new_del_ids);
		 			$(`.link_row_${link_id}`).remove();
		 		});

		 		$(document).on('click','.link_del-post',function(e){
		 			e.preventDefault();
		 			var link_id = $(this).attr('data-id');
		 			$(`.link_row_${link_id}`).remove();
		 		});

		 });
	</script>
	@endsection