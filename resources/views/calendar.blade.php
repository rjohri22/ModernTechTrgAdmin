@extends('layouts.app')
@section('content')
<section class="page-title" style="background-image: url(assets/images/breadcrum/about.png);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1>Calender</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Calender</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="faq-section-five" style="background:#fff;">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-9">
            	<div id="dates-calendar" class="dates-calendar"></div>
            </div>
            <div class="col-sm-3">
            	<div class="card">
            		<div class="card-header">
            			<h4>Selected Dates</h4>
            		</div>
					<form action="{{ route('submit_calender') }}" method="post">
					@csrf
					<input type="hidden" name="id" value="{{ $job_id }}">
					<input type="hidden" name="interviwe_id" value="{{ $interviewr_id }}">
            		<div class="card-body selectDate">
            		</div>
					<div class="card-footer">
						<button class="btn btn-success" type="submit">Submit</button>
					</div>
					</form>
            	</div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets/plugins/full_calender/main.js') }}"></script>
<script src="{{ asset('assets/plugins/full_calender/intrac_main.js') }}"></script>
<script src="{{ asset('assets/plugins/full_calender/daygridmain.js') }}"></script>
<script>
	var calendarEl,calendar,lastId,formModal;
	calendarEl = document.getElementById('dates-calendar');
	if(calendar){
		calendar.destroy();
	}
	calendar = new FullCalendar.Calendar(calendarEl, {
		plugins: [ 'dayGrid' ,'interaction'],
		header: {},
		selectable: true,
		selectMirror: false,
		allDay:false,
		editable: false,
		eventLimit: true,
		defaultView: 'dayGridMonth',
		events:{
			url:"{{route('load_dates')}}",
			extraParams:{
				id:'<?php echo $interviewr_id;?>',
			}
		},
		loading:function (isLoading) {
			if(!isLoading){
				$(calendarEl).removeClass('loading');
			}else{
				$(calendarEl).addClass('loading');
			}
		},
		select: function(arg) {
			console.log(arg.startStr);
		},
		eventClick:function (info) {
			var len=$(".selectDate > div").length;
			console.log(len);
			if(len < 3){
				var d = new Date(info.event.start);
				var curr_date = d.getDate();
				var curr_month = d.getMonth();
				var curr_year = d.getFullYear();
				newDate = curr_year+"-"+curr_month+"-"+curr_date;
				var html = '';
				html += '<div class="dateslist" style="background: lightgrey; padding: 16px">';
					html += '<input type="hidden" name="sdate[]" value="'+newDate+'" >';
					html += '<input type="hidden" name="stime[]" value="'+info.event.extendedProps.time+'" >';
					html += '<div class="row">';
						html += '<div class="col-sm-9">';
							html += '<strong>'+newDate+'</strong>';
							html += '<br>';
							html += '<strong>'+info.event.extendedProps.time+'</strong>';
						html += '</div>';
						html += '<div class="col-sm-3">';
							html += '<button class="btn btn-danger deleteDate">X</button>';
						html += '</div>';
					html += '</div>';
				html += '</div>';
				$('.selectDate').append(html);
			}
			else{
				alert("You can select only 3 dates");
			}

		},
		eventRender: function (info) {
			$(info.el).find('.fc-title').html(`(${info.event.extendedProps.time}) - ${info.event.title}`);
		}
	});
	calendar.render();

	$('#del_task').click(function(e){
		e.preventDefault();
		var task_id = $('#task_id').val();
		var url = '<?php echo route('admin.calender.delete_task')?>?id='+task_id;
		window.location.href = url;
	});
	$('.selectDate').on('click','.deleteDate',function(){
		console.log('delete');
		$(this).closest('.dateslist').remove();
	});
</script>
@endsection