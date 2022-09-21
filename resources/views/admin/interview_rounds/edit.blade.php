@extends('admin.layout.master')
@section('content')
<style>
    .table thead tr th{
        text-align:left !important;
    }
    .table tbody tr td{
        text-align:left !important;
    }

</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">

		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-12">
						<h5 class="card-title d-inline">Edit Interview Round</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{route('admin.interview_rounds.update')}}" method="post">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<label class="form-label">Profile</label>
                            <select class="form-control" name="profile">
                                @foreach($bends as $bend)
                                    <option value="{{ $bend->id }}" @if($bend->id == $interviewrounds->profile_id ) selected @endif >{{ $bend->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id" value="{{ $interviewrounds->id }}" >
						</div>	
					</div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Rounds</label>
                            <select name="round" id="round" class="form-control">
                                @foreach($rounds as $round)
                                    <option value="{{ $round->id }}" data-name="{{ $round->name }}" >{{ $round->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div style="margin-top: 35px;" ></div>
                            <input type="button" value="Fatch Questions" class="btn btn-sm btn-primary"  id="fatchQuestions" data-bs-toggle="modal" data-bs-target="#questionsModal">
                        </div>
                    </div>
					<br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-boardered" id="selectRoundTable" >
                                <thead>
                                    <tr>
                                        <th style="text-align:left" >Round</th>
                                        <th style="width:150px">No of Questions</th>
                                        <th style="width:150px">Time (Minutes)</th>
                                        <th style="width:350px">Disclaimer</th>
                                        <th style="width:150px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sno = 0;
                                    @endphp
                                    @foreach($interviewroundquestions as $row)
                                        @php
                                            $sno++;
                                        @endphp
                                        <tr id='tr{{ $sno }}' >
                                            <input type='hidden' name='round_id[]' value='{{ $row->round_id }}' >
                                            <input type='hidden' name='round_questions[]' id='round_questions{{ $sno }}' value='[{{ $row->ids }}]' >
                                            <td>{{ $row->round_name }}</td>
                                            <td id='no_question{{ $sno }}' >{{ $row->count_questions }}</td>
                                            <td><input type='number' value='{{ $row->interview_time }}' name='round_time[]' class='form-control' ></td>
                                            <td><textarea name='round_disclaimer[]' class='form-control' >{{ $row->disclaimer }}</textarea></td>
                                            <td>
                                                <button type='button' class='btn btn-sm btn-primary roundEdit' data-rid='{{ $row->round_id }}' data-questions='[{{ $row->ids }}]' data-sno='{{ $sno }}'  data-bs-toggle='modal' data-bs-target='#questionsModal' >Edit</button>
                                                <button type='button' class='btn btn-sm btn-danger roundDelete' data-sno='{{ $sno }}' >Remove</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" >Submit</button>
                        </div>
                    </div>
    			</form>
			</div>
		</div>
	</main>
</div>
<!-- Modal -->
<div class="modal fade" id="questionsModal" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#fatchQuestions').click(function(){
            var round_id = $('#round').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('admin.interview_rounds.questions')}}",
                type: 'POST',
                data: {round_id:round_id},
                success: function(data) {
                    // var obj = jQuery.parseJSON(data);
                    // console.log(obj);
                    $('#questionsModal .modal-content').html(data);
                }
            });
        });
        var sno = 0;
        $('#questionsModal').on('click','#addRound',function(){
            sno++;
            var html = "";
            var round_id = $('#round').val();
            var round_name = $('#round option:selected').data('name');
            var ids = [];
            $('.questCheckbox:checkbox:checked').each(function () {
                var assignid = (this.checked ? $(this).val() : "");
                ids.push(assignid);
            });
            console.log(ids);
            var noofquestion = ids.length;
            ids = JSON.stringify(ids);
            console.log(ids);
            
            html += "<tr id='tr"+sno+"' >";
                html += "<input type='hidden' name='round_id[]' value='"+round_id+"' >";
                html += "<input type='hidden' name='round_questions[]' id='round_questions"+sno+"' value='"+ids+"' >";
                html += "<td>"+round_name+"</td>";
                html += "<td id='no_question"+sno+"' >"+noofquestion+"</td>";
                html += "<td><input type='number' value='0' name='round_time[]' class='form-control' ></td>";
                html += "<td><textarea name='round_disclaimer[]' class='form-control' ></textarea></td>";
                html += "<td>";
                    html += "<button type='button' class='btn btn-sm btn-primary roundEdit' data-rid='"+round_id+"' data-questions='"+ids+"' data-sno='"+sno+"'  data-bs-toggle='modal' data-bs-target='#questionsModal' >Edit</button>";
                    html += "<button type='button' class='btn btn-sm btn-danger roundDelete' data-sno='"+sno+"' >Remove</button>";
                html += "</td>";
            html += "</tr>";
            $('#selectRoundTable tbody').append(html);

        });
        $(document).on('click','.roundEdit',function(){
            var round_id = $(this).data('rid');
            var sno = $(this).data('sno');
            // var questions = $(this).data('questions');
            var questions = $("#round_questions"+sno).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('admin.interview_rounds.questions_update')}}",
                type: 'POST',
                data: {sno:sno,round_id:round_id,questions:questions},
                success: function(data) {
                    console.log(data);
                    $('#questionsModal .modal-content').html(data);
                }
            });
        });
        $('#questionsModal').on('click','#editRound',function(){
            var msno = $(this).data('sno');
            var ids = [];
            $('.questCheckbox:checkbox:checked').each(function () {
                var assignid = (this.checked ? $(this).val() : "");
                ids.push(assignid);
            });
            var noofquestion = ids.length;
            ids = JSON.stringify(ids);
            $('#round_questions'+msno).val(ids);           
            $('#no_question'+msno).html(noofquestion);           
        });
        $(document).on('click','.roundDelete',function(){
            var sno = $(this).data('sno');
            // console.log(sno);
            $('#tr'+sno).remove();
        });
        
        
    });
</script>
@endsection
