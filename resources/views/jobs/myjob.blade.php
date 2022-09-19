
@extends('layouts.app')

@section('content')
@php
use App\Models\Admin\Oppertunities;
use App\Models\Admin\Jobs;
@endphp
<section class="page-title" style="background-image: url(assets/images/breadcrum/about.png);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1>My Jobs</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">                
                @foreach($jobs as $job)
                <div class="career-block col-lg-4 col-md-6">
                    <div class="inner-box">
                        <div class="time">{{str_replace('_',' ',$job->compensation_mode)}}</div>
                        
                        <div class="icon"> <img src="{{ asset('assets/front_assets/images/business-logo/Raichand_TRADING.jpg') }}" alt="" class="imagess" style="height:120px;"></div>

                        <h4>{{$job->band_name}}</h4>
                        <a href="#" class="theme-btn btn-style-one">
                            <span class="btn-title" data-toggle="modal" data-target="#myModal{{$job->id}}">View Details</span>
                        </a>
                        <ul class="list">
                            <li><a href="#"><i class="flaticon-clock-2"></i>Location: {{$job->country}}</a></li>
                            <li><a href="#"><i class="flaticon-money"></i>Applicant: 7</a></li>
                            <li><a href="#"><i class="flaticon-money"></i>{{str_replace('_',' ',$job->work_style)}}</a></li>
                        </ul>
                        <br>
                    </div>
                </div>


                <div class="modal right fade" id="myModal{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$job->id}}" style="background: rgba(0, 0, 0, 0.31);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Job Description</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{$job->oppertunity_id}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Created by</th>
                                        <td>Administrator</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Hirarchy Band</th>
                                        <td>{{$job->band_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Reporting Manager</th>
                                        <td>Admin</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6><b>Responsibilities</b></h6>
                            <br>
                            <div class="f-17">
                                <?php echo $job->responsibilities;?>
                                <!-- <ul class="checklist-ul">
                                    <li>Develop technical and business requirements and always strive to deliver intuitive and
                                        user-centered solutions</li>
                                    <li> Communicate with clients to understand their business goals and objectives</li>
                                    <li> Optimize existing user interface designs</li>
                                    <li> Detecting and resolving user experience issues (e.g. responsiveness)</li>
                                    <li> Combine creativity with an awareness of the design elements</li>
                                    <li>Test new ideas before implementing</li>
                                    <li>Conduct an ongoing user research</li>
                                </ul> -->
                            </div>
                            <br>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Work Type</th>
                                        @php
                                            $work_type = '';
                                            if($job->work_type == '1'){
                                                $work_type = 'Part Time';
                                            }
                                            if($job->work_type == '2'){
                                                $work_type = 'Full Time';
                                            }
                                        @endphp
                                        <td>{{$work_type}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Work Shift </th>
                                        <td>{{$job->work_shift}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pay Range</th>
                                        @php
                                            $salary_type = '';
                                            if($job->salary_type == '1'){
                                                $salary_type = 'Month';
                                            }
                                            if($job->salary_type == '2'){
                                                $salary_type = 'Year';
                                            }
                                            if($job->salary_type == '3'){
                                                $salary_type = 'Day';
                                            }
                                        @endphp
                                        <td>₹{{$job->min_salary}} - ₹{{$job->max_salary}} per {{$salary_type}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Eligibility Criteria</th>
                                        <td>
                                            <?php echo $job->description;?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Round Name</th>
                                  <th scope="col">Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($job->rounds as $round)
                                <tr>
                                  <td>{{$round}}</td>
                                  <td>Passed</td>
                                </tr>
                                @endforeach
                                
                              </tbody>
                            </table>
                        </div>
                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->
                @endforeach
            </div>

        </div>
    </div>
</div>

@endsection
