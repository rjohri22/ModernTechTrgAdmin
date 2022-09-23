@extends('admin.layout.master')
@section('content')

<style>
.jp_detail,.round_detail {
	font-size:12px
}
.jp_detail tr td {
	padding: .5rem .5rem !important;
}
.round_detail tr td {
	padding: .5rem .5rem !important;
	text-align:left !important;
}

</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="card container mt-2" style="background: white">
	<br>

	<div class="card-header">
		<h3>Job Application</h3>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-4">
				<table class="table table-bordered jp_detail">
					<tr>
						<th colspan="2" style="text-align:center" >Job Seeker Detail</th>
					</tr>
					<tr>
						<th>Full Name</th>
						<td>{{ $jobseeker->first_name." ".$jobseeker->last_name }}</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{ $jobseeker->email }}</td>
					</tr>
					<tr>
						<th>Phone</th>
						<td>{{ $jobseeker->phone }}</td>
					</tr>
					<tr>
						<th>Education</th>
						<td>{{ $jobseeker->education }}</td>
					</tr>
					<tr>
						<th>Occupation</th>
						<td>{{ $jobseeker->occupation }}</td>
					</tr>
					<tr>
						<th>Working Experience</th>
						<td>{{ $jobseeker->total_work_experience }}</td>
					</tr>
					<tr>
						<th>Last Job Title</th>
						<td>{{ $jobseeker->last_job_title }}</td>
					</tr>
					<tr>
						<th>Last Job Durration</th>
						<td>{{ $jobseeker->last_job_company_duration }}</td>
					</tr>
					<tr>
						<th>Annual Salary</th>
						<td>{{ $jobseeker->annual_inhand_salary }}</td>
					</tr>
					<tr>
						<th>Available To Koin</th>
						<td>{{ $jobseeker->available_to_join }}</td>
					</tr>
					@if(isset($interviewer->id))
						<tr>
							<th>Interviewer Name</th>
							<td>{{ $interviewer->first_name." ".$interviewer->last_name }}</td>
						</tr>
						@php
							$dates = explode(',',$jobapplication->js_interview_datetime)
						@endphp
						@foreach($dates as $key => $d)
							<tr>
								<th>Interview Date {{ $key+1 }}</th>
								<td>{{ $d }}</td>
							</tr>
						@endforeach
					@endif
				</table>
			</div>
			<div class="col-md-8">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="job-tab" data-bs-toggle="tab" data-bs-target="#job" type="button" role="tab" aria-controls="home" aria-selected="true">Job Detail</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="rounds-tab" data-bs-toggle="tab" data-bs-target="#rounds" type="button" role="tab" aria-controls="home" aria-selected="true">Interview Rounds</button>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="job" role="tabpanel" aria-labelledby="job-tab">
						<table class="table table-bordered jp_detail">
							<tr>
								<th>Profile</th>
								<td>{{ $job->profile }}</td>
								<th>Company</th>
								<td>{{ $job->company }}</td>
								<th>Country</th>
								<td>{{ $job->country }}</td>
							</tr>
							<tr>
								<th>State</th>
								<td>{{ $job->state }}</td>
								<th>City</th>
								<td>{{ $job->city }}</td>
								<th>Min Salary</th>
								<td>{{ $job->min_salary }}</td>
							</tr>
							<tr>
								<th>Max Salary</th>
								<td>{{ $job->max_salary }}</td>
								<th>Work Type</th>
								<td>{{ $job->work_type == 1 ? "Part Time" : "Full Time" }}</td>
								<th>Working Stype</th>
								<td>{{ ucfirst($job->work_style) }}</td>
							</tr>
							<tr>
								<th>Working Shift</th>
								<td>{{ ucfirst($job->work_shift) }}</td>
								<th>Compensation Mode</th>
								<td>{{ ucwords(str_replace('_',' ',$job->compensation_mode)) }}</td>
								<th>Wages</th>
								<td>
									@if($job->salary_type == 1)
										Monthly
									@elseif ($job->salary_type == 2)
										Yearly
									@elseif ($job->salary_type == 3)
										Daily
									@else
										Not specified
									@endif

								</td>
							</tr>
							<tr>
								<th colspan="6" >Daily Job</th>
							</tr>
							<tr>
								<td colspan="6" style="text-align:left" >{!! $job->daily_job !!}</td>
							</tr>
							<tr>
								<th colspan="6" >Responsibilities</th>
							</tr>
							<tr>
								<td colspan="6" style="text-align:left" >{!! $job->responsibilities !!}</td>
							</tr>
						</table>
					</div>
					<div class="tab-pane fade" id="rounds" role="tabpanel" aria-labelledby="rounds-tab">
						<table class="table table-bordered round_detail">
							<tr>
								<th>S.No</th>
								<th>Round</th>
								<th>No of Qestions</th>
								<th>No of Attem Qestions</th>
								<th>Total Marks</th>
								<th>Passing Marks</th>
								<th>Obtain Marks</th>
								<th></th>
							</tr>
							@php $sno = 1 @endphp
							@foreach($rounds as $round)
								<tr>
									<td>{{ $sno++ }}</td>
									<td>{{ $round->name }}</td>
									<td>{{ $round->no_o_questions }}</td>
									<td>{{ $round->attem_questions }}</td>
									<td>{{ $round->total_marks }}</td>
									<td>{{ $round->passing_marks }}</td>
									<td>{{ $round->obtain_marks }}</td>
									<td><button class="btn btn-primary attemQestions" data-uid="{{ $jobapplication->jobseeker_id }}" data-jaid="{{ $jobapplication->id }}" data-rid="{{ $round->round_id }}" data-bs-toggle='modal' data-bs-target='#questionsModal' >Questions</button></td>
								</tr>
							@endforeach

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="questionsModal" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
        $(document).on('click','.attemQestions',function(){
			var jaid = $(this).data('jaid');
			var rid = $(this).data('rid');
			var uid = $(this).data('uid');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('admin.jobapplications.attemquestion')}}",
                type: 'POST',
                data: {jaid:jaid,rid:rid,uid:uid},
                success: function(res) {
                    $('#questionsModal .modal-content').html(res);
                }
            });

        });

	});

</script>

@endsection