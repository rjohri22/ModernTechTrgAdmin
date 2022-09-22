<style>
    .table tbody tr th{
        font-weight:bold !important;
    }
    .table tbody tr td{
        text-align:left;
    }
</style>
<div class="modal-header">
    <h5 class="modal-title" id="questionsModalLabel">Attempt Questions</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered" id="questionTable" >
                <thead>
                    <tr>
                        <td>Qestions</td>
                        <td>Correct Answer</td>
                        <td>User Answer</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody style="text-align:left" >
                    @foreach($questions as $question)
                        <tr >
                            <td>{{ $question->question}}</td>
                            <td>{{ $question->correct_answer}}</td>
                            <td>{{ $question->user_answer}}</td>
                            <td>
                                @if($question->status == 1)
                                    Wrrong
                                @elseif ($question->status == 2)
                                    Correct
                                @else
                                    No Attempt
                                @endif
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

