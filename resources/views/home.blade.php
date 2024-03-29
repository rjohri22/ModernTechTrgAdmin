@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('is_login'))
                        <div class="alert alert-success" role="alert">
                            {{ ('Successfully Login') }}
                        </div>
                    @endif
                    <h5>Profile Completion ({{round($profile_completion)}}%)</h5>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{round($profile_completion)}}%"></div>
                    </div>
                    <br>
                    <a class="btn btn-primary" href="{{ route('profile') }}">Setup Profile</a>
                </div>
            </div>
            @foreach($Jobs as $Job)
            <br>
            <div class="card">
                <div class="card-body">
                    <h6>{{$Job->title}}</h6>
                    <p>{{$Job->summery}}</p>
                    <p><strong>Salary</strong><br>{{$Job->min_salary}} - {{($Job->max_salary) ? $Job->max_salary : 0}}</p>
                    <br>
                    @if(in_array($Job->id, $products))
                    <a class="btn btn-success" href="javascript:void()" style="opacity: 0.5">Applied</a>
                    @else
                    <a class="btn btn-primary" href="{{ route('apply_job',$Job->id) }}">Apply</a>
                    @endif

                </div>
            </div> 
            @endforeach
        </div>
    </div>
</div>
@endsection
