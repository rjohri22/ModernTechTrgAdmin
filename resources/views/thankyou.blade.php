@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    Thank you !<br>
                    Your Appication Has Submit Successfully!
                    <br>
                    <hr>
                    <a href="{{route('home')}}" class="btn btn-primary btn-sm">Back To Job Seeking</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
