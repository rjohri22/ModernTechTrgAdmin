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
		        	<form method="post" action="{{route('store_attempt_interview',$job_id)}}">
		        		@csrf
	            	<table class="table">
	            		<tr>
	            			<th>{{$duration}}</th>
	            		</tr>
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


<div class="modal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background: rgba(0, 0, 0, 0.31);">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title" id="myModalLabel2">Congratulations</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	        </div>
	        <div class="modal-body">
	        	<h3 style="text-align: center;">You Have Passed The Round 1 !</h3>
	        	<br>
	        	<center>
	            	<button class="btn btn-primary">Move To Next Round</button>
	        	</center>
	        </div>
	    </div>
	</div>
</div>


<div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background: rgba(0, 0, 0, 0.31);">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title" id="myModalLabel2">Alas</h4>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	        </div>
	        <div class="modal-body">
	        	<h3 style="text-align: center;">Opps you Failed try Again Sometime </h3>
	        	<br>
	        	<center>
	            	<a href="{{route('career')}}" class="btn btn-danger">Back To Job Seeking</a>
	        	</center>
	        </div>
	    </div>
	</div>
</div>

	@if($message = Session::get('success'))
		<script type="text/javascript">
			$(document).ready(function(){
				$('#successModal').modal('show');
			});
		</script>
	@endif
	@if($error_ = Session::get('error_'))
		<script type="text/javascript">
			$(document).ready(function(){
				$('#errorModal').modal('show');
			});
		</script>
	@endif
	

	<script type="text/javascript">
		console.log('asdasd');
		$(document).ready(function(){
			$(document).on('hidden.bs.modal','#errorModal',function(){
				window.location.href = '{{route("career")}}';
			});
		});
	</script>
@endsection