@extends('admin.layout.master')
@section('content')
<style>
	div.box-body{
		overflow-x: scroll;
	}
</style>

<div class="page-wrapper mdc-toolbar-fixed-adjust">
	<main class="content-wrapper">
		<div class="mdc-card info-card info-card--success">
			<div class="card-inner">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="card-title d-inline">Interview Rounds</h5>
					</div>
					<div class="col-sm-4">
						<a href="{{route('admin.interview_rounds.add')}}" class="btn btn-primary" style="float: right;">Add Interview Round</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table id="example" class="table table-striped table-bordered datatable">
					<thead>
						<tr>
							<th scope="col" style="width: 20%">Profile</th>
							<!-- <th scope="col" style="width: 20%">Interview Time</th> -->
							<th scope="col" style="width: 20%">No of Rounds</th>
							<th scope="col" style="width: 20%">No of Questions</th>
							<th scope="col" style="width: 20%">Actions</th>
						</tr>
					</thead>
					<tbody>

						@foreach($rows as $row)

							<tr>
								<td>{{ $row->profile }}</td>
								<!-- <td>{{ $row->interview_time }} min</td> -->
								<td>{{ $row->no_rounds }}</td>
								<td>{{ $row->no_question }}</td>
								<td>
									<a href="{{route('admin.interview_rounds.questions_list',$row->id)}}" class="btn btn-primary btn-sm">Questions</a>
									<a href="{{route('admin.interview_rounds.edit',$row->id)}}" class="btn btn-info btn-sm">Edit</a>
									<button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-bs-placement="left" data-bs-trigger="focus" title="Delete Oppertunity" data-bs-html="true" data-bs-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.interview_rounds.delete',$row->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</main>
</div>
@endsection
