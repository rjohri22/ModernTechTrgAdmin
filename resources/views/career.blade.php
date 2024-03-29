@extends('layouts.app')
@section('content')
<section class="page-title" style="background-image: url(assets/images/breadcrum/about.png);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1>Careers</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="faq-section-five" style="background:#fff;">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-form-area" style="background:#fff;">
                    <form method="get" action="{{ route('career') }}" class="contact-form">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Keywords</label>
                                <input type="text" name="keyword" value="{{ $skeyword }}" placeholder="Search Here" >
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Profile</label>
                                <select class="form-control" name="profile" id="exampleFormControlSelect1">
                                    <option value="" >All</option>
                                    @foreach($profiles as $profile)
                                        <option value="{{ $profile->id }}" @if($sprofile == $profile->id) selected @endif >{{ $profile->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Business</label>
                                <select class="form-control" name="business"  id="exampleFormControlSelect1">
                                    <option value="" >All</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" @if($sbusiness == $company->id) selected @endif  >{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Country</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option value="" >All</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if($scountry == $country->id) selected @endif >{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="btn-title">Search</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Career Section -->
<section class="career-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h3<span class="career-font">Be a part of The Raichand Group.<br><i>A new way of working. A new way of
                    understanding.</i>
                <div class="text-decoration">
                    <span class="left"></span>
                    <span class="right"></span>
                </div>
        </h3<span></div>
        <div class="col-lg-12 col-md-12 text-center">
            <p>
                <span class="career-font1"><i>Let’s do
                        it
                        together. Grow Together.</i> </span><br><br>
                We're building a culture at The Raichand Group where amazing people like you can do their best work.
                It’s rewarding, balanced and with cross functional exposure. We like to work with
                people having right character rather than skills and academic qualifications. The
                opportunity to challenge yourself, polish your skills, take up ownership and groom
                leader inside you. <br><br>
                The prospect of being surrounded by smart, ambitious, motivated people. If you see
                your values align with our organization's values, come join us.</p>
        </div>
        <div class="col-lg-12 col-md-12 text-center pt-35">
            <!--<h2>Discover more about TRG</h2>-->
        </div>
    </div>
</section>

<section class="career-section">
    <div class="auto-container">
        <div class="row">
            @foreach($Jobs as $k => $j)
            <div class="career-block col-lg-4 col-md-6">
                <div class="inner-box">
                    <div class="time">{{str_replace('_',' ',$j->compensation_mode)}}</div>
                    <div class="icon"> <img src="{{ asset('assets/front_assets/images/business-logo/Raichand_TRADING.jpg') }}" alt="" class="imagess" style="height:120px;"></div>
                    <h4>{{$j->band_name}}</h4>
                    <a href="#" class="theme-btn btn-style-one">
                        <span class="btn-title" data-toggle="modal" data-target="#myModal{{$j->id}}">View Details</span>
                    </a>
                    <ul class="list">
                        <li><a href="#"><i class="flaticon-clock-2"></i>Location: {{$j->country}}</a></li>
                        <li><a href="#"><i class="flaticon-money"></i>Applicant: ???</a></li>
                        @php
                        	$date = date('Y-m-d');
                        	$job_created = date('Y-m-d',strtotime($j->created_at));
                        	$unix_now = strtotime($date);
                        	$unix_created = strtotime($job_created);
                        	$datediff = $unix_now - $unix_created;
                        	$day_ago = round($datediff / (60 * 60 * 24));

                        @endphp
                        <li><a href="#"><i class="flaticon-money"></i>{{$day_ago}} Days Ago</a></li>
                        <li><a href="#"><i class="flaticon-money"></i>{{str_replace('_',' ',$j->work_style)}}</a></li>
                    </ul>
                    <br>
                    <!-- <a href="#" class="theme-btn btn-style-one">-->
                    <!--    <span class="btn-title">View</span>-->
                    <!--</a>-->
                </div>
            </div>
            <div class="modal right fade" id="myModal{{$j->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$j->id}}" style="background: rgba(0, 0, 0, 0.31);">
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
			                            <td>{{$j->oppertunity_id}}</td>
			                        </tr>
			                        <tr>
			                            <th scope="row">Created by</th>
			                            <td>Administrator</td>
			                        </tr>
			                        <tr>
			                            <th scope="row">Hirarchy Band</th>
			                            <td>{{$j->band_name}}</td>
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
			                	<?php echo $j->responsibilities;?>
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
			                            	if($j->work_type == '1'){
			                            		$work_type = 'Part Time';
			                            	}
			                            	if($j->work_type == '2'){
			                            		$work_type = 'Full Time';
			                            	}
			                            @endphp
			                            <td>{{$work_type}}</td>
			                        </tr>
			                        <tr>
			                            <th scope="row">Work Shift </th>
			                            <td>{{$j->work_shift}}</td>
			                        </tr>
			                        <tr>
			                            <th scope="row">Pay Range</th>
			                            <!-- <td>₹{{$j->min_salary}} - ₹480,000.00 per anum</td> -->
			                            @php
				                            $salary_type = '';
			                            	if($j->salary_type == '1'){
			                            		$salary_type = 'Month';
			                            	}
			                            	if($j->salary_type == '2'){
			                            		$salary_type = 'Year';
			                            	}
			                            	if($j->salary_type == '3'){
			                            		$salary_type = 'Day';
			                            	}
			                            @endphp
			                            <td>₹{{$j->min_salary}} - ₹{{$j->max_salary}} per {{$salary_type}}</td>
			                        </tr>
			                        <tr>
			                            <th scope="row">Eligibility Criteria</th>
			                            <td>
			                                <?php echo $j->description;?>
			                               <!--  <ul class="checklist-ul">
			                                    <li>Masters</li>
			                                    <li> BCom</li>
			                                    <li> B.Sc</li>
			                                </ul> -->
			                            </td>
			                        </tr>
			                    </tbody>
			                </table>
			                <table class="table">
			                  <thead>
			                    <tr>
			                      <th scope="col">Round Name</th>
			                      <th scope="col">Round Type</th>
			                      <th scope="col"> Interviewer Designation</th>
			                    </tr>
			                  </thead>
			                  <tbody>
                                @foreach($j->rounds as $round)
                                <tr>
                                  <td colspan="2">{{$round}}</td>
                                  <td>??</td>
                                  <td>??</td>
                                </tr>
                                @endforeach
			                    
			                    <!-- <tr>
			                      <td>Communication</td>
			                      <td>F2F</td>
			                      <td>HR Manager</td>
			                    </tr>
			                    <tr>
			                      <td>Technical</td>
			                      <td>In Person </td>
			                      <td>Sales Manager</td>
			                    </tr> -->
			                  </tbody>
			                </table>
                            @if(in_array($j->id, $products))
                                <center>
                                    <button type="submit" class="theme-btn btn-style-one">
                                        <span class="btn-title">You Have Already Applied for This Job</span>
                                    </button>
                                </center>
                                @if(isset($interviewer[$k]) && $interviewer[$k] != null)
                                    <a href="{{route('jb_calender',['id' => $interviewer[$k],'jid'=>$j->id])}}" class="btn btn-primary">Select Dates</a>
                                @endif
                            @else
                                <form method="post" action="{{route('apply_for_job')}}">
                                    <center> 
                                            @csrf
                                            <span><strong>Do You Want to Relocate ?</strong></span>
                                            <input type="checkbox" name="reloaction" value="1" required="">
                                            <input type="hidden" name="job_id" value="{{$j->id}}">
                                            <br>
                                            <br>
                                            <button type="submit" class="theme-btn btn-style-one">
                                                <span class="btn-title">Apply</span>
                                            </button>
                                            <!-- <button type="submit" class="btn-title">Apply</button> -->
                                        <!-- <a href="{{route('apply_job',$j->id)}}" class="theme-btn btn-style-one">
                                            
                                        </a> -->
                                    </center>
                                    </form>
                            @endif
			            </div>

			        </div><!-- modal-content -->
			    </div><!-- modal-dialog -->
			</div><!-- modal -->
            @endforeach
        </div>
    </div>
</section>



<section class="sidebar-page-container">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-6 content-side">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('assets/front_assets/images/resource/hire.jpg') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Life at Raichand </h5>
                        <br>
                        <a href="life-at-raichand.php" class="btn btn-dark">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 content-side">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('assets/front_assets/images/resource/recuit.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Recruitment Journey</h5>
                        <!--<p class="card-text">We want you to experience new and innovative journey of your job-->
                        <!--    application with-->
                        <!--    The Raichand Group. Fully Digital and get notified at each steps.</p><br>-->
                            <br>
                        <a href="recruitment-journey.php" class="btn btn-dark">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section-two bg-oliver" style="padding: 15px 0px 15px;">
    <div class="auto-container">
        <div class="row align-items-center">

            <div class="col-lg-8 text-center">
                <!--<h5>Write Us at </h5>-->
                <h5>Join our Talent Network to stay up-to-date with our latest job vacancies</h5>
            </div>
            <div class="col-lg-4">
                <div class="wrapper-box">
                    <div class="contact-info">
                        <!--<div class="icon"><span class="flaticon-call-1"></span></div>-->
                        <!--<h4>(555) 890 1234 </h4>--><br>
                        <a href="career-portal.php" class="theme-btn blink"><span class="btn-title">Apply Now</span></a>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection