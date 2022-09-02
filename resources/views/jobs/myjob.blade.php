@extends('layouts.app')

@section('content')
@php
use App\Models\Admin\Oppertunities;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Jobs') }}</div>
            </div>
            @foreach($jobs as $job)
                @php
                    $oppertunity = Oppertunities::where('id',$job->oppertunity_id)->first();
                @endphp
            <br>
            <a href="{{route('apply_job',$oppertunity->id)}}" style="text-decoration: none; color: black">
                <div class="card">
                    <div class="card-body">
                        <h6>{{$oppertunity->title}}</h6>
                        <p>{{$oppertunity->summery}}</p>
                        <p><strong>Salary</strong><br>{{$oppertunity->min_salary}} - {{($oppertunity->max_salary) ? $oppertunity->max_salary : 0}}</p>

                        @if($job->status == 0)
                            <span class="btn bg-warning text-white">Pending</span>
                        @elseif($job->status == 1)
                            <span class="btn bg-info text-white">Shortlist</span>
                        @elseif($job->status == 2)
                            <span class="btn bg-danger text-white">Rejected</span>
                        @elseif($job->status == 3)
                            <span class="btn bg-primary text-white">Interview</span>
                        @elseif($job->status == 4)
                            <span class="btn bg-primary text-white">Onboarding</span>
                            <br>
                            <br>
                            @if($job->offer_letter_status == 1)
                                <div class="alert alert-success">
                                    You Have Accept The Offer Letter Which is Send Via Email
                                </div>
                            @elseif($job->offer_letter_status == 2)
                                <div class="alert alert-danger">
                                    You Have Reject The Offer Letter Which is Send Via Email
                                </div>
                            @else
                            <div class="card">
                                <div class="card-header">
                                    <strong>An Offer Letter Send To You Via Email (Do you Want To Accept It ?)</strong><br>
                                </div>
                                <div class="card-body">
                                    <button class="btn btn-success change_status" data-job-id="{{$job->id}}" data-status="1">Accept Offer Letter</button>
                                    <button class="btn btn-danger change_status" data-job-id="{{$job->id}}" data-status="2">Reject Offer Letter</button>
                                </div>
                            </div>
                            @endif
                        @elseif($job->status == 5)
                            <span class="btn bg-success text-white">Hired</span>
                        @endif
                    </div>
                </div> 
            </a>
            @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.change_status').click(function(e){
            e.preventDefault();
            var job_id = $(this).attr('data-job-id');
            var status = $(this).attr('data-status');
        });
    });
</script>
@endsection
