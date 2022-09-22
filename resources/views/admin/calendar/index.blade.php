@extends('admin.layout.master')
@section('content')

<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">
		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<h5>Calender</h5>
				</div>
			</div>
			<div class="card-body">
				<div id="dates-calendar" class="dates-calendar"></div>
			</div>
		</div>
	</main>
</div>


<div class="modal" tabindex="-1" id="task_modal">
  <div class="modal-dialog">
	<form action="" method="post" id="add-task_from">
		@csrf
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Add Task</h4>
		</div>
		<div class="modal-body">
			<div class="row">
					<div class="col-sm-12">
						<label>Date</label>
						<input type="date" name="date" class="form-control" id="date_sel" readonly="">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Time</label>
						<select class="form-control" name="time" id="time">
							<option value="">Select Time</option>
							<?php 
								$start_time = strtotime('08:30');
								$h = 8;
								$m = 30;
								for($i=0; $i < 17; $i++){
										$start_time_2 = date('H:i',strtotime('+30 minutes',$start_time)); 
										$start_time = strtotime($start_time_2);
										// $start_time = strtotime("+30 minutes",strtotime($start_time)); 
										// $m = $m+30;
										// if($m == 60){
										// 	$h= $h+1;
										// 	$m = 0;
										// }
									?>
									<option value="<?php echo $start_time_2; ?>"><?php echo $start_time_2; ?></option>
								<?php }
							?>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Title</label>
						<input type="text" name="title" class="form-control" id="title">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						<label>Message</label>
						<textarea class="form-control" rows="5" name="message" id="message"></textarea>
					</div>
				</div>
		</div>

		<div class="modal-footer">
			<button id="del_task" class="btn btn-danger">Delete Task</button>
			<input type="hidden" name="task_id" id="task_id">
			<input type="submit" class="btn btn-primary" name="save" value="Save">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
	</form>
</div>
</div>


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
			url:"{{route('admin.load_task')}}",
			extraParams:{
				id:1,
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
			$('#date_sel').val(arg.startStr);
			$('#time').val('');
			$('#time').val('');
			$('#title').val('');
			$('#message').val('');
			$('#del_task').hide();
			$('#add-task_from').attr('action','<?php echo route('admin.calender.store_data')?>');
			$('#task_modal').modal('show');
		},
		eventClick:function (info) {
			var form = Object.assign({},info.event.extendedProps);
			// form.start_date = moment(info.event.start).format('YYYY-MM-DD');
			// form.end_date = moment(info.event.start).format('YYYY-MM-DD');
			form.id = info.event.id;
			form.title = info.event.title;
			form.message = info.event.description;
			console.log(info.event.start);
			var formattedDate = new Date(info.event.start);
			var d = formattedDate.getDate();
			var m =  formattedDate.getMonth();
			m += 1;  // JavaScript months are 0-11
			var y = formattedDate.getFullYear();
			if (d < 10) {
		        d = "0" + d;
		    }
		    if (m < 10) {
		        m = "0" + m;
		    }
			var date = (y + "-" + m + "-" + d);
			$('#date_sel').val(date);
			$('#time').val(form.time);
			$('#title').val(form.title);
			$('#message').val(form.description);
			$('#task_id').val(form.id);
			$('#del_task').show();
			$('#add-task_from').attr('action','<?php echo route('admin.calender.update_data')?>');
			$('#task_modal').modal('show');
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