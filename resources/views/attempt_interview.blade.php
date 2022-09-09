@extends('layouts.app')
@section('content')
<section class="page-title" style="background-image: url(assets/images/breadcrum/about.png);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1>Interview</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Interview</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="faq-section-five" style="background:#fff;">
    <div class="auto-container">
        <div class="row">
	            <div class="col-lg-12">
		        	<form method="post" action="{{route('store_attempt_interview')}}">
		        		@csrf
	            	<table class="table">
	            		@foreach($questions as $k => $q)
            			<input type="hidden" name="question_id[]" value={{$q->id}}>
	            		<tr>
	            			<th colspan="2">{{$k+1}}. {{$q->question}}</th>
	            		</tr>
	            		@if($q->question_type == 1)
	            		<tr>
	            			<td colspan="2"><input type="text" name="correc_ans[]" class="form-control" placeholder="your answer"></td>
	            		</tr>
	            		@else
	            		<tr>
	            			<td>
	            				<input type="radio" name="correc_ans[]" value="A">
	            				<label>{{$q->option_a}}</label>
	            			</td>
	            			<td>
	            				<input type="radio" name="correc_ans[]" value="B">
	            				<label>{{$q->option_b}}</label>
	            			</td>
	            		</tr>
	            		<tr>
	            			<td>
	            				<input type="radio" name="correc_ans[]" value="C">
	            				<label>{{$q->option_c}}</label>
	            			</td>
	            			<td>
	            				<input type="radio" name="correc_ans[]" value="D">
	            				<label>{{$q->option_d}}</label>
	            			</td>
	            		</tr>
	            		@endif
	            		@endforeach
	            	</table>
	            	<button type="submit" class="btn btn-primary">Submit</button>
		        	</form>
	        	</div>
        </div>
    </div>
</section>

@endsection