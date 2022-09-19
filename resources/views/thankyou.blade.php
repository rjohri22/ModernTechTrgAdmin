@extends('layouts.app')

@section('content')
<section class="page-title" style="background-image: url(assets/images/breadcrum/about.png);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1>Thankyou</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body text-center">
                    <img src="{{ asset('assets/front_assets/thankyou.png') }}" style="width: 200px"><br>
                    
                    @if($id != null)
                    <strong>Your Appication Has Submit Successfully!</strong><br>
                    <strong>Would You Like To Start Your Interview ?</strong>
                    <br>
                    <hr>
                    <a href="{{route('attempt_interview',$id)}}" class="btn btn-primary btn-sm">Start Your Interview</a>
                    @else
                    @if ($message = Session::get('message'))
                        <?php echo $message; ?>
                    @endif
                   <!--  <strong>Thankyou!</strong><br>
                    <strong>We Will Contact You Shortly</strong>
                    <br> -->
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@endsection
