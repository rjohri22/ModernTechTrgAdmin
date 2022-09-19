
@extends('layouts.app')
@section('content')
@php
use App\Models\Admin\Countries;

$countries = Countries::get();
@endphp
<section class="page-title" style="background-image: url(assets/images/breadcrum/about.png);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1>Register</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Setup Your Profile</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="faq-section-five" style="background:#fff;">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-form-area p-5" style="background:#fff;">
                    @if ($errors->any())
                        <div class="container">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    <form method="POST" action="{{ route('register') }}" id="reg_form">
                         @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Basic Information</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>First Name</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                             <div class="col-sm-4">
                                <label>Last Name</label>
                                 <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                 @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="col-sm-4">
                                <label>Country Code</label>
                                <select name="country" class="form-control @error('country') is-invalid @enderror" autocomplete="country" autofocus>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $c)
                                        <option value="{{$c->code}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                             <div class="col-sm-4">
                                <label>Mobile</label>
                                <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="col-sm-4">
                                <label>Email</label>
                                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                             <div class="col-sm-4">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="col-sm-4">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Professional Information</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Occupation</label>

                                <select name="occupation" class="form-control @error('occupation') is-invalid @enderror" required autocomplete="country" autofocus>
                                    <option class="">Select Occupation</option>
                                    <option class="student">Student</option>
                                    <option class="professional">Professional</option>
                                    <option class="curruntly employeed">Curruntly Employeed</option>
                                </select>
                                @error('occupation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="col-sm-4">
                                <label>Curruntly Employeed ?</label>
                                <select name="curruntly_employeed" class="form-control @error('curruntly_employeed') is-invalid @enderror" required autocomplete="curruntly_employeed" autofocus>
                                    <option class="">Select Value</option>
                                    <option class="1">Yes</option>
                                    <option class="0">No</option>
                                </select>
                                @error('curruntly_employeed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="col-sm-4">
                                <label>Total Work Experience</label>
                                <input id="total_work_experience" type="number" class="form-control @error('total_work_experience') is-invalid @enderror" name="total_work_experience" required autocomplete="new-total_work_experience">
                                 @error('total_work_experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                             <div class="col-sm-3">
                                <label>Currunt / Last job title</label>
                                 <input id="last_job_title" type="text" class="form-control @error('last_job_title') is-invalid @enderror" name="last_job_title" required autocomplete="last_job_title">
                                  @error('last_job_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="col-sm-3">
                                <label>Currunt / Last Company Name</label>
                                <input id="last_job_company" type="text" class="form-control @error('last_job_company') is-invalid @enderror" name="last_job_company" required autocomplete="last_job_company">
                                @error('last_job_company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label>Duration In the Company</label>
                                <input id="last_job_company_duration" type="text" class="form-control @error('last_job_company_duration') is-invalid @enderror" name="last_job_company_duration" required autocomplete="last_job_company_duration">
                                @error('last_job_company_duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label>Annual Inhand Salary</label>
                                <input id="annual_inhand_salary" type="number" class="form-control @error('annual_inhand_salary') is-invalid @enderror" name="annual_inhand_salary" required autocomplete="annual_inhand_salary">
                                @error('annual_inhand_salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                             <div class="col-sm-4">
                                <label>Availabel to Join (Days)</label>
                                <input id="available_to_join" type="number" class="form-control @error('available_to_join') is-invalid @enderror" name="available_to_join" required autocomplete="available_to_join">
                                @error('available_to_join')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="col-sm-4">
                                <label>Education</label>
                                <select name="education" class="form-control @error('education') is-invalid @enderror" required autocomplete="education">
                                    <option class="">Select Education</option>
                                    <option class="Phd / Doctorate">Phd / Doctorate</option>
                                    <option class="Master / Post Graduation">Master / Post Graduation</option>
                                    <option class="Graduation / Diploma">Graduation / Diploma</option>
                                    <option class="12th">12th</option>
                                    <option class="10th">10th</option>
                                    <option class="Below 10th">Below 10th</option>
                                </select>
                                @error('education')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                             <div class="col-sm-4">
                                <label>Uplaod Resumr</label>
                                <input type="file" name="resume" class="form-control">
                            </div>
                             <div class="col-sm-4">
                                <label>Profile Pic</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary" id="submit_form" name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function(){

        // $('#reg_form').submit(function(e){
        $('#submit_form').click(function(e){
            e.preventDefault();
            // $('#reg_form').submit();
            var annual_inhand_salary = ($('#annual_inhand_salary').val()) ? $('#annual_inhand_salary').val() : 0;
            // // if (confirm(`Your Annual Inhand Salary Is <br> ${annual_inhand_salary} <br> do you want to Contineu`) == true) {
            // //   $('#reg_form').submit();
            // // }
            Swal.fire({
                  title: `Your Annual Inhand Salary Is <br> ${annual_inhand_salary} <br> do you want to Contineu`,
                  showDenyButton: true,
                  confirmButtonText: 'Yes',
                  denyButtonText: `No`,
                }).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                    console.log('adsad');
                    document.getElementById("reg_form").submit();
                    // $('#reg_form').submit();
                  }
                })
        })
    });
</script>
@endsection