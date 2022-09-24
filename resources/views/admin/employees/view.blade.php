@extends('admin.layout.master')
@section('content')


<div class="card container mt-2" style="background: white">
  <br>

  <div class="card-header">
    <h3>Employee</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-4">
        <table class="table table-bordered jp_detail">
          <tr>
            <th colspan="2" style="text-align:center" >Details</th>
          </tr>
          <tr>
            <th>Full Name</th>
            <td>{{$user->first_name}} {{$user->last_name}}</td>
          </tr>
          <tr>
            <th>Job title</th>
            <td>{{$user->desired_job_title}}</td>
          </tr>
          <tr>
            <th>Location</th>
            <td>{{$user->country}}, {{$user->state}}, {{$user->city}}</td>
          </tr>
          <tr>
            <th>Skills</th>
            <td>
              @php
              $skills = explode(',',$user->skills);
            @endphp
            @foreach($skills as $skill)
              <span class="label label-primary">{{$skill}}</span>
            @endforeach
            </td>
          </tr>
        </table>
      </div>
      <div class="col-md-8">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="resume-tab" data-bs-toggle="tab" data-bs-target="#resume" type="button" role="tab" aria-controls="home" aria-selected="true">Resume Info</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="education-tab" data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab" aria-controls="home" aria-selected="true">Education</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab" aria-controls="home" aria-selected="true">Experience</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="certificate-tab" data-bs-toggle="tab" data-bs-target="#certificate" type="button" role="tab" aria-controls="home" aria-selected="true">Certificate</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="language-tab" data-bs-toggle="tab" data-bs-target="#language" type="button" role="tab" aria-controls="home" aria-selected="true">Language</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="link-tab" data-bs-toggle="tab" data-bs-target="#link" type="button" role="tab" aria-controls="home" aria-selected="true">Link</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
          
          <div class="tab-pane fade" id="resume" role="tabpanel" aria-labelledby="resume-tab">
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

          <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
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

          <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
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
          </div>

          <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
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
          </div>

          <div class="tab-pane fade" id="language" role="tabpanel" aria-labelledby="language-tab">
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
          </div>

          <div class="tab-pane fade" id="link" role="tabpanel" aria-labelledby="link-tab">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection