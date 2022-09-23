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
            		<div class="card-body">
            			<div class="" style="background: lightgrey; padding: 16px">
            				<div class="row">
            					<div class="col-sm-9">
		            				<strong>22-09-2022</strong>
		            				<br>
		            				<strong>3:30</strong>
            					</div>
            					<div class="col-sm-3">
            						<button class="btn btn-danger">X</button>
            					</div>
            				</div>
            			</div>
            		</div>
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
			// formModal.show({
			// 	start_date:moment(arg.start).format('YYYY-MM-DD'),
			// 	end_date:moment(arg.end).format('YYYY-MM-DD'),
			// });
			// var start_date = arg.startStr.format('YYYY-MM-DD');
			console.log(arg.startStr);
			// $('#date_sel').val(arg.startStr);
			// $('#time').val('');
			// $('#time').val('');
			// $('#title').val('');
			// $('#message').val('');
			// $('#del_task').hide();
			// $('#add-task_from').attr('action','<?php echo route('admin.calender.store_data')?>');
			// $('#task_modal').modal('show');
		},
		eventClick:function (info) {
			// var form = Object.assign({},info.event.extendedProps);
			// // form.start_date = moment(info.event.start).format('YYYY-MM-DD');
			// // form.end_date = moment(info.event.start).format('YYYY-MM-DD');
			// form.id = info.event.id;
			// form.title = info.event.title;
			// form.message = info.event.description;
			// console.log(info.event.start);
			// var formattedDate = new Date(info.event.start);
			// var d = formattedDate.getDate();
			// var m =  formattedDate.getMonth();
			// m += 1;  // JavaScript months are 0-11
			// var y = formattedDate.getFullYear();
			// if (d < 10) {
		 //        d = "0" + d;
		 //    }
		 //    if (m < 10) {
		 //        m = "0" + m;
		 //    }
			// var date = (y + "-" + m + "-" + d);
			// $('#date_sel').val(date);
			// $('#time').val(form.time);
			// $('#title').val(form.title);
			// $('#message').val(form.description);
			// $('#task_id').val(form.id);
			// $('#del_task').show();
			// $('#add-task_from').attr('action','<?php echo route('admin.calender.update_data')?>');
			// $('#task_modal').modal('show');
			// formModal.show(form);
		},
		eventRender: function (info) {
			console.log(info.event.extendedProps);
			// $(info.el).prepend( "<div class='ibox-tools'><a style='background-color: red; color:white; margin-right: 10px; padding:0px 6px' class='pull-left'><i class='fa fa-times closeon'></i></a></div>" );
			$(info.el).find('.fc-title').html(`(${info.event.extendedProps.time}) - ${info.event.title}`);

			// $(info.el).find(".closeon").on('click', function() {
   //          	$('#calendar').fullCalendar('removeEvents',event._id);
	  //           console.log('delete');
   //          });
		}
	});
	calendar.render();

	$('#del_task').click(function(e){
		e.preventDefault();
		var task_id = $('#task_id').val();
		var url = '<?php echo route('admin.calender.delete_task')?>?id='+task_id;
		window.location.href = url;
	});
</script>
@endsection