@extends('admin.layout.master')
@section('content')

<section class="content">
	<div class="row">
		<div class="col-md-3">
			
			<div class="">
				<main class="content-wrapper">

					<div class="mdc-card info-card info-card--success">
						<div class="card-inner">
							<div class="row">
								<div class="col-sm-12">
									<h5 class="card-title d-inline">Basic Profile</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<img class="profile-user-img img-responsive img-circle" src="{{URL::asset('public/images/

								profile/'.$user->profile_pic)}}" alt="User profile picture">

								<h3 class="profile-username text-center">{{$user->first_name}} {{$user->last_name}}</h3>

								<p class="text-muted text-center">{{$user->desired_job_title}}</p>
						</div>
					</div>
				</main>
			</div>

			<br>
			<div class="">
				<main class="content-wrapper">

					<div class="mdc-card info-card info-card--success">
						<div class="card-inner">
							<div class="row">
								<div class="col-sm-12">
									<h5 class="card-title d-inline">Change Profile Pic</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<form action="{{route('admin.change_user_profile',$user->id)}}" method="post" enctype="multipart/form-data">
								@csrf
								<label>Change Profile Pic</label>
								<input type="hidden" name="pre_profile_image" id="pre_profile_image" value="{{$user->profile_pic}}">
								<input type="file" name="profile_url" class="form-control"><br>
								<button class="btn btn-primary" type="submit">Save</button>
							</form>
						</div>
					</div>
				</main>
			</div>

			<br>
			<div class="">
				<main class="content-wrapper">

					<div class="mdc-card info-card info-card--success">
						<div class="card-inner">
							<div class="row">
								<div class="col-sm-12">
									<h5 class="card-title d-inline">Change Password</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<form action="{{route('admin.change_password',$user->id)}}" method="post" enctype="multipart/form-data">
								@csrf
								<label>New Password</label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
								<br>
								<label>Confirm Password</label>
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

								<br>
								<button class="btn btn-primary" type="submit">Change Password</button>
							</form>
						</div>
					</div>
				</main>
			</div>

			<!-- <div class="box box-primary">
				<div class="box-body box-profile">

					
				</div>
			</div> -->




			<!-- <div class="box box-primary">
				<div class="box-body box-profile">
					
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-header">
					<label>Change Password</label>
				</div>
				<div class="box-body box-profile">
					
				</div>
			</div> -->
		</div>

		
		<div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
					<li><a href="#resume" data-toggle="tab">Resume Info</a></li>
					<li><a href="#education" data-toggle="tab">Education</a></li>
					<li><a href="#experience" data-toggle="tab">Experienced</a></li>
					<li><a href="#certificate" data-toggle="tab">Certificates</a></li>
					<li><a href="#language" data-toggle="tab">Language</a></li>
					<li><a href="#link" data-toggle="tab">Links</a></li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="profile">
						<form action="{{route('admin.update_job_seeker',$user->id)}}" method="post">
							@csrf
							<table class="table table-bordered">
								<tr>
									<th>First Name</th>
									<td><input type="text" name="first_name" value="{{$user->first_name}}" class="form-control"></td>
								</tr>
								<tr>
									<th>Last Name</th>
									<td><input type="text" name="last_name" value="{{$user->last_name}}" class="form-control"></td>
								</tr>
								<tr>
									<th>Email</th>
									<td><input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required readonly autocomplete="email"></td>
								</tr>
								<tr>
									<th>Phone</th>
									<td><input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$user->phone}}" required autocomplete="phone"></td>
								</tr>
								<tr>
									<th>Address (Primary)</th>
									<td><input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address_1" value="{{$user->address_primary}}" required autocomplete="address"></td>
								</tr>
								<tr>
									<th>Address (Secondary)</th>
									<td><input id="address_2" type="text" class="form-control @error('address') is-invalid @enderror" name="address_2" value="{{$user->address_secondary}}" required autocomplete="address"></td>
								</tr>
								<tr>
									<th>Profile</th>
									<td>
										<select class="form-control" name="bend" id="bend">
											<option value="">Select Bend</option>
											@foreach($bends as $bend)
											<option value="{{$bend->id}}" data-type="{{$bend->band_type}}" {{($bend->id == $user->bend_id) ? "selected" : ""}}>{{$bend->name}}</option>
											@endforeach
										</select>
									</td>
								</tr>
								<tr class="business_area">
									<th>Business</th>
									<td>
										<select class="form-control" name="business" id="bend">
											<option value="">Select Business</option>
											@foreach($business as $b)
											<option value="{{$b->id}}" {{($b->id == $user->company_id) ? "selected" : ""}}></option>
											@endforeach
										</select>
									</td>
								</tr>
								<tr class="country_area">
									<th>Country</th>
									<td>
										<select class="form-control" name="country" id="bend">
											<option value="">Select Country</option>
											@foreach($countries as $c)
											<option value="{{$c->id}}" {{($c->id == $user->country) ? "selected" : ""}}>{{$c->name}}</option>
											@endforeach
										</select>
									</td>
								</tr>
							</table>
							<button type="submit" class="btn btn-primary">Save Profile</button>

						</form>
					</div>

					<div class="tab-pane" id="resume">
						<form action="{{route('admin.update_user_resume',$user->id)}}" method="post" enctype="multipart/form-data">
							@csrf
							<table class="table table-bordered">
								<tr>
									<th style="width: 30%">Headline</th>
									<td style="width: 70%">
										<input type="text" name="headline" value="{{$user->headline}}" class="form-control">
									</td>
								</tr>
								<tr>
									<th>Summery</th>
									<td><input type="text" name="summery" class="form-control" value="{{$user->summery}}"></td>
								</tr>
								<tr>
									<th>Resume Type</th>
									<td>
										<select class="form-control" name="resume_type">
											<option value="1" {{($user->resume_type == 1) ? "selected" : ""}}>Private</option>
											<option value="0" {{($user->resume_type == 0) ? "selected" : ""}}>Public</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>Desired Job Title</th>
									<td>
										<input type="text" name="desired_job_title" class="form-control" value="{{$user->desired_job_title}}">
									</td>
								</tr>
								<tr>
									<th>Desired Salary</th>
									<td>
										<input type="number" name="desired_salary" value="{{$user->desired_salary}}" class="form-control">
									</td>
								</tr>
								<tr>
									<th>Desired Period</th>
									<td>
										<select class="form-control" name="desired_period" id="desired_period">
											<option value="monhtly" {{$user->desired_period == 'monthly' ? 'selected' : '' }}>Monthly</option>
											<option value="yearly" {{$user->desired_period == 'yearly' ? 'selected' : '' }}>Yearly</option>
											<option value="daily" {{$user->desired_period == 'daily' ? 'selected' : '' }}>Daily</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>Desired Job Type</th>
									<td>
										<select class="form-control" name="desired_jobtype" id="desired_jobtype">
											<option value="full_time" {{$user->desired_jobtype == 'full_time' ? 'selected' : '' }}>Full Time</option>
											<option value="part_time" {{$user->desired_jobtype == 'part_time' ? 'selected' : '' }}>Part Time</option>
										</select>
									</td>
								</tr>
								<tr>
									<th>Resume Attachment</th>
									<td>
										<input type="file" name="resume_attachment" id="resume_attachment" class="form-control">
										<input type="hidden" name="pre_resume_attachment" id="pre_resume_attachment" value="{{$user->resume_attachment}}">
									</td>
								</tr>
							</table>
							<button type="submit" class="btn btn-primary">Save Resume</button>
						</form>
					</div>
					<div class="tab-pane" id="education">
						<div class="row">
							<div class="col-sm-12"> 
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>{{('Level')}}</label>
											<select id="edu_level" class="form-control" >
												<option value="" >Select</option>
												<option value="HSC">HSC</option>
												<option value="SSC">SSC</option>
												<option value="Bachelors">Bachelors</option>
												<option value="Masters">Masters</option>
											</select>
											<!-- <input type="text" id="edu_level" class="form-control"> -->
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
											<label>{{('Course Specialization')}}</label>
											<input type="text" id="edu_field" class="form-control">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>{{('Country')}}</label>
											<input type="text" id="edu_country" class="form-control" value="">
										</div>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>{{('State')}}</label>
											<input type="text" id="edu_state" class="form-control" value="">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>{{('City')}}</label>
											<input type="text" id="edu_city" class="form-control" value="">
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
								<form action="{{route('admin.store_user_education',$user->id)}}" method="post" id="education-frm">
									@csrf
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>{{('Level')}}</th>
												<th>{{('Institude Name')}}</th>
												<th>{{('Course Specialization')}}</th>
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

									<button type="submit" class="btn btn-primary">Save Education</button>
								</form>
							</div>
						</div>

					</div>

					<div class="tab-pane" id="experience">
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
											<input type="text" id="work_country" class="form-control" value="">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>{{'State'}}</label>
											<input type="text" id="work_state" class="form-control" value="">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>{{'City'}}</label>
											<input type="text" id="work_city" class="form-control" value="">
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
								<form action="{{route('admin.store_user_experience',$user->id)}}" method="post" id="work-frm">
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
									<button type="submit" class="btn btn-primary">Save Experience</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="certificate">
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
								<form action="{{route('admin.store_user_certificate',$user->id)}}" method="post" id="certificate-frm">
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
									<button type="submit" class="btn btn-primary">Save Certificate</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="language">
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
								<form action="{{route('admin.store_user_language',$user->id)}}" method="post" id="language-frm">
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
									<button class="btn btn-primary" type="submit">Save Language</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane" id="link">
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
								<form action="{{route('admin.store_user_link',$user->id)}}" method="post" id="link-frm">
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
									<button class="btn btn-primary" type="submit">Save Links</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

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
		$('#bend').trigger('change');


		var counter = '{{$counter}}';
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

		$(document).on('click','.del-pre',function(e){
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

		var work_counter = '{{$work_counter}}';
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

		var certificate_counter = '{{$certificate_counter}}';
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


		var language_counter = '{{$language_counter}}';
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

		var links_counter = '{{$links_counter}}';
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