@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    div.box-body{
        overflow-x: scroll;
    }
    table td, table th {
        text-align:left !important;
    }
</style>
<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">
		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="card-title d-inline">Rounds</h5>
					</div>
					<div class="col-sm-4">
                        <button type='button' style="float: right;" class='btn btn-sm btn-primary addRound' data-bs-toggle='modal' data-bs-target='#roundMOdel' >Add Round</button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example" class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%">#</th>
                            <th scope="col" style="width: 80%">Title</th>
                            <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0
                        @endphp
                        @foreach($rounds as $round)
                            @php
                                $count++
                            @endphp
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $round->name }}</td>
                                <td>
                                    <button type='button' class='btn btn-sm btn-primary editRound' data-id="{{ $round->id }}" data-bs-toggle='modal' data-bs-target='#roundMOdel' >Edit</button>
                                    <!-- <button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Round" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.rounds.delete',$round->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button> -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>
		</div>
	</main>
</div>
<!-- Modal -->
<div class="modal fade" id="roundMOdel" tabindex="-1" aria-labelledby="roundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    $(document).on('click','.addRound',function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('admin.rounds.add') }}",
            type: 'GET',
            success: function(data) {
                $('#roundMOdel .modal-content').html(data);
            }
        });
        
    });
    $(document).on('click','.editRound',function(){
        var id = $(this).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {id:id},
            url: "{{ route('admin.rounds.edit') }}",
            type: 'POST',
            data: {id:id},
            success: function(data) {
                $('#roundMOdel .modal-content').html(data);
            }
        });
    });
</script>


@endsection
