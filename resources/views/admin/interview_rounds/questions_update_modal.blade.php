<style>
    .table tbody tr th{
        font-weight:bold !important;
    }
    .table tbody tr td{
        text-align:left;
    }
</style>
<div class="modal-header">
    <h5 class="modal-title" id="questionsModalLabel">Modal title</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <label class="form-label">Department</label>
            <select name="department" id="department" class="form-control">
                <option value="0">All Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->title }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="col-md-12">
            <table class="table table-striped table-bordered" id="questionTable" >
                <thead>
                    <tr>
                        <td style="width:50px" ></td>
                        <td>Qestions</td>
                        <td style="width:130px" >Question Type</td>
                    </tr>
                </thead>
                <tbody style="text-align:left" >
                    @foreach($questions as $question)
                        <tr class="departmenttr{{ $question->department_id }}">
                            <td>
                                <input class="form-check-input questCheckbox" type="checkbox" 
                                @if(in_array($question->id,$selectQuestion))
                                    checked
                                @endif
                                 name="selectQes[]" id="selectQes{{ $question->id}}" value="{{ $question->id}}">
                            </td>
                            <td>{{ $question->question}}</td>
                            <td>{{ $question->question_type == 0 ? "Objecytive" : "Subjective" }}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="editRound" data-rid="{{ $round_id }}" data-sno="{{ $sno }}" data-bs-dismiss="modal">Round Update</button>
</div>

<script>
    $(document).ready(function(){
        $('#department').change(function(){
            var department = $(this).val();
            if(department == 0){
                $('#questionTable tbody tr').show();
            }
            else{
                $('#questionTable tbody tr').hide();
                $('.departmenttr'+department).show();
            }
        });
    });
</script>
