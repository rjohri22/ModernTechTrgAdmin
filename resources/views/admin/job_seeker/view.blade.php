@extends('admin.layout.master')
@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="{{URL::asset('public/images/profile/'.$user->profile_pic)}}" alt="User profile picture">

          <h3 class="profile-username text-center">{{$user->first_name}} {{$user->last_name}}</h3>

          <p class="text-muted text-center">{{$user->desired_job_title}}</p>

          <!-- <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Total Applied Job</b> <a class="pull-right">1,322</a>
            </li>
          </ul> -->
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">About Me</h3>
        </div>
        <div class="box-body">
          <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
          <p class="text-muted">{{$user->country}}, {{$user->state}}, {{$user->city}}</p>
          <hr>
          <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
          <p>
            @php
              $skills = explode(',',$user->skills);
            @endphp
            @foreach($skills as $skill)
              <span class="label label-primary">{{$skill}}</span>
            @endforeach
          </p>
        </div>
      </div>
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
            <table class="table table-bordered">
              <tr>
                <th>First Name</th>
                <td>{{$user->first_name}}</td>
              </tr>
              <tr>
                <th>Last Name</th>
                <td>{{$user->last_name}}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>{{$user->email}}</td>
              </tr>
              <tr>
                <th>Address (Primary)</th>
                <td>{{$user->address_primary}}</td>
              </tr>
              <tr>
                <th>Address (Secondary)</th>
                <td>{{$user->address_secondary}}</td>
              </tr>
              <tr>
                <th>Country</th>
                <td>{{$user->country}}</td>
              </tr>
              <tr>
                <th>State</th>
                <td>{{$user->state}}</td>
              </tr>
              <tr>
                <th>City</th>
                <td>{{$user->city}}</td>
              </tr>
              <tr>
                <th>Postal Code</th>
                <td>{{$user->postal_code}}</td>
              </tr>
            </table>
          </div>

          <div class="tab-pane" id="resume">
            <table class="table table-bordered">
              <tr>
                <th style="width: 30%">Headline</th>
                <td style="width: 70%">{{$user->headline}}</td>
              </tr>
              <tr>
                <th>Summery</th>
                <td>{{$user->summery}}</td>
              </tr>
              <tr>
                <th>Resume Type</th>
                <td>{{($user->resume_type == 1) ? "Private" : "Public"}}</td>
              </tr>
              <tr>
                <th>Desired Job Title</th>
                <td>{{$user->desired_job_title}}</td>
              </tr>
              <tr>
                <th>Desired Salary</th>
                <td>{{$user->desired_salary}}</td>
              </tr>
              <tr>
                <th>Desired Period</th>
                <td>{{ucwords($user->desired_period)}}</td>
              </tr>
              <tr>
                <th>Desired Job Type</th>
                <td>{{str_replace('_',' ',ucwords($user->desired_jobtype))}}</td>
              </tr>
              <tr>
                <th>Resume Attachment</th>
                <td>{{$user->resume_attachment}}</td>
              </tr>
            </table>
          </div>
          <div class="tab-pane" id="education">
            <ul class="timeline timeline-inverse">
              @foreach($education as $edu)
              <li>
                <div class="timeline-item">
                  <h3 class="timeline-header"><a href="#">{{$edu->institute_name}}</a></h3>
                  <div class="timeline-body">
                    <b>{{$edu->field_name}} ({{$edu->level}})</b><br>
                    <b>{{$edu->city}}, {{$edu->state}}, {{$edu->country}}</b><br>
                    <b>{{date('d-M-Y',strtotime($edu->period_from))}} - {{date('d-M-Y',strtotime($edu->period_to))}}</b><br>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>

          <div class="tab-pane" id="experience">
            <ul class="timeline timeline-inverse">
              @foreach($works as $work)
              <li>
                <div class="timeline-item">
                  <h3 class="timeline-header"><a href="#">{{$work->title}}</a></h3>
                  <div class="timeline-body">
                    <b>{{$work->company}}</b><br>
                    <b>{{$work->city}}, {{$work->state}}, {{$work->country}}</b><br>
                    <b>{{date('d-M-Y',strtotime($work->period_from))}} - {{date('d-M-Y',strtotime($work->period_to))}}</b><br>
                    <b>Description</b><br>
                    <p>{{$work->description}}</p>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>

          <div class="tab-pane" id="certificate">
             <ul class="timeline timeline-inverse">
              @foreach($certificate as $cert)
              <li>
                <div class="timeline-item">
                  <h3 class="timeline-header"><a href="#">{{$cert->title}}</a></h3>
                  <div class="timeline-body">
                    <b>{{$cert->institute_name}}</b><br>
                    <b>{{date('d-M-Y',strtotime($cert->period_from))}} - {{date('d-M-Y',strtotime($cert->period_to))}}</b><br>
                    <b>Description</b><br>
                    <p>{{$cert->description}}</p>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>

          <div class="tab-pane" id="language">
            <ul class="timeline timeline-inverse">
              @foreach($language as $lang)
              <li>
                <div class="timeline-item">
                  <div class="timeline-body">
                    <b>{{$lang->title}}</b><br>
                    <b>{{$lang->proficiency}}</b><br>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>

          <div class="tab-pane" id="link">
            <ul class="timeline timeline-inverse">
              @foreach($links as $link)
              <li>
                <div class="timeline-item">
                  <div class="timeline-body">
                    <b>{{$link->title}}</b><br>
                    <a href="{{$link->link}}" target="_blank">{{$link->link}}</a><br>
                  </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection