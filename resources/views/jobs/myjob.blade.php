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
@endsection
