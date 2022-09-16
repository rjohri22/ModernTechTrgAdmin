<style>
    .table tbody tr th{
        font-weight:bold !important;
    }
    .table tbody tr td{
        text-align:left;
    }
</style>
<form action="{{ route('admin.rounds.store') }}" method="post">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title">Add Round</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" >
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Round Add</button>
    </div>
</form>

