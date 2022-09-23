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
			<div class="col-lg-9">
				<form method="post" action="{{route('store_attempt_interview',$job_id)}}" id="ques_tbl">
					@csrf
					<table class="table">
						<input type="hidden" name="total_question" value={{count($questions)}}>
						@foreach($questions as $k => $q)
						<input type="hidden" name="question_id[]" value={{$q->id}}>
						<tr>
							<th colspan="2">{{$k+1}}. {{$q->question}}</th>
						</tr>
						@if($q->question_type == 1)
						<tr>
							<td colspan="2"><input type="text" name="correc_ans_{{$q->id}}" class="form-control" placeholder="your answer"></td>
						</tr>
						@else
						<tr>
							<td>
								<input type="radio" name="correc_ans_{{$q->id}}" value="A">
								<label>{{$q->option_a}}</label>
							</td>
							<td>
								<input type="radio" name="correc_ans_{{$q->id}}" value="B">
								<label>{{$q->option_b}}</label>
							</td>
						</tr>
						<tr>
							<td>
								<input type="radio" name="correc_ans_{{$q->id}}" value="C">
								<label>{{$q->option_c}}</label>
							</td>
							<td>
								<input type="radio" name="correc_ans_{{$q->id}}" value="D">
								<label>{{$q->option_d}}</label>
							</td>
						</tr>
						@endif
						@endforeach
					</table>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="col-sm-3">
				<h4 id="timer" style="display: none">00</h4>
				<div class="row">
					<div class="col-sm-4">
						<div style="width: 100%; text-align: center">
							<span style="font-size: 40px" id="time_hr">00</span>
							<hr>
							<span style="font-size: 20px">HR</span>
						</div>
					</div>
					<div class="col-sm-4">
						<div style="width: 100%; text-align: center">
							<span style="font-size: 40px" id="time_min">00</span>
							<hr>
							<span style="font-size: 20px">Min</span>
						</div>
					</div>
					<div class="col-sm-4">
						<div style="width: 100%; text-align: center;">
							<span style="font-size: 40px" id="time_sec">00</span>
							<hr>
							<span style="font-size: 20px">Sec</span>
						</div>
					</div>
				</div>			
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


<div class="modal" id="disclaimer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background: rgba(0, 0, 0, 0.31);">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel2">Disclaimer</h4>
			</div>
			<div class="modal-body">
				<p >{{$disclaimer}}</p>
				<br>
				<center>
					<button class="btn btn-primary" id="ok_disclaimer">Start Test</button>
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#disclaimer').modal('show');
	});
</script>

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
		$('#ok_disclaimer').click(function(){
			start_test();
			$('#disclaimer').modal('hide');
		});
	});


	function start_test(){

		<?php 
		$hours = 00;
		$minutes = 00;
		$seconds = 00;
		$hours = $duration/60;
		$hours = floor($hours); 
		$minutes = $duration - ($hours*60); 
		?>
		<?php if ($hours != 00 || $minutes != 00 || $seconds != 00) {
			?>
			document.getElementById('timer').innerHTML = <?php echo (!empty($hours)) ? $hours : "00"; ?> + ":" +  <?php echo (!empty($minutes)) ? $minutes : "00"; ?> + ":" + <?php echo (!empty($seconds)) ? $seconds : "00"; ?>;

			startTimer();

		<?php } else{  ?>  startCounter(); <?php }  ?>
	}

	function timerEndAction() { $("form#ques_tbl").submit(); }


	function startTimer() {
		var presentTime = document.getElementById('timer').innerHTML;
		  var tA = presentTime.split(/[:]+/); // h = tA[0];  m = tA[1];  s = tA[2];
		  tA[0] = parseInt(tA[0]); tA[1] = parseInt(tA[1]); tA[2] = parseInt(tA[2]);

		  tA[2]=tA[2]-1; if(tA[2]==-1){ tA[2]=59; tA[1]=tA[1]-1; if(tA[1]==-1){ tA[1]=59; tA[0]=tA[0]-1; } }

		  if (tA[0] < 10 && tA[0] >= 0) {tA[0] = "0" + tA[0]}; 
		  if (tA[1] < 10 && tA[1] >= 0) {tA[1] = "0" + tA[1]};
		  if (tA[2] < 10 && tA[2] >= 0) {tA[2] = "0" + tA[2]};

		  if(tA[0]<0){ 
		  	document.getElementById('timer').innerHTML = '<span style="color : red;">EXPIRED</span>'; 
		  	timerEndAction(); return; 
		  }
		  
		  document.getElementById('timer').innerHTML = tA[0] + ":" + tA[1] + ":" + tA[2];

		  document.getElementById('time_hr').innerHTML = tA[0];
		  document.getElementById('time_min').innerHTML = tA[1];
		  document.getElementById('time_sec').innerHTML = tA[2];

		  setTimeout(startTimer, 1000);
		}

		function startCounter() {
			document.getElementById('timer').innerHTML = "00" + ":" +  "00" + ":" + "00";
			timeCounter();
		}

		function timeCounter() {
			var presentTime = document.getElementById('timer').innerHTML;
		  var tA = presentTime.split(/[:]+/); // h = tA[0];  m = tA[1];  s = tA[2];
		  tA[0] = parseInt(tA[0]); tA[1] = parseInt(tA[1]); tA[2] = parseInt(tA[2]);

		  tA[2]=tA[2]+1; if(tA[2]== 60){ tA[2]=0; tA[1]=tA[1]+1; if(tA[1]==60){ tA[1]=0; tA[0]=tA[0]+1; } }
		  
		  if (tA[0] < 10 && tA[0] >= 0) {tA[0] = "0" + tA[0]}; 
		  if (tA[1] < 10 && tA[1] >= 0) {tA[1] = "0" + tA[1]};
		  if (tA[2] < 10 && tA[2] >= 0) {tA[2] = "0" + tA[2]};

		  if(tA[0]>24){ // max time limit 24 hours
		  	document.getElementById('timer').innerHTML = '<span style="color : red;">EXPIRED</span>'; 
		  	timerEndAction(); return; 
		  }
		  
		  document.getElementById('timer').innerHTML = tA[0] + ":" + tA[1] + ":" + tA[2];

		  document.getElementById('time_hr').innerHTML = tA[0];
		  document.getElementById('time_min').innerHTML = tA[1];
		  document.getElementById('time_sec').innerHTML = tA[2];

		  setTimeout(timeCounter, 1000);
		}
	</script>

	@endsection