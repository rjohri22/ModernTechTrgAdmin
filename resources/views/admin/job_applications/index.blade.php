@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<h3>Job Applications</h3>
	</div>
	<div class="box-body">
		<table class="table table-sm">
		  <thead>
		    <tr>
				<th scope="col">#</th>
				<th scope="col">Job</th>
				<th scope="col">Job Seeker</th>
				<th scope="col">Apply Date</th>
				<th scope="col">Actions</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@php
			{{$counter = 1;}}
			@endphp
		    @foreach($applicatoins as $ja) 
		    <tr>
				<td>{{ $counter }}</td>
				<td>{{ $ja->profile_name }}</td>
				<td>{{ $ja->first_name." ".$ja->last_name }}</td>
				<td>{{ $ja->created_at->format('d-m-Y') }}</td>
				<td>
					<a href="{{route('admin.jobapplications.view',$ja->id)}}" class="btn btn-primary btn-sm">View</a>
					<!-- <a href="{{route('admin.jobapplications.edit',$ja->id)}}" class="btn btn-info btn-sm">Edit</a> -->
					<!-- <button type="button" class="btn btn-sm btn-danger" data-toggle="popover" data-placement="left" data-trigger="focus" title="Delete Oppertunity" data-html="true" data-content="<b>Are You Sure ?</b><hr><a href='{{route('admin.jobapplications.delete',$ja->id)}}' class='btn btn-success btn-sm'>I am Sure</a>&nbsp;<a class='btn btn-danger btn-sm'>No</a>">Delete</button> -->
				</td>
		    </tr>
		    @php
			{{$counter++;}}
			@endphp
		    @endforeach
		  </tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change','.status-change',function(){
			var status = $(this).val();
			var id = $(this).attr('data-id');

			if(status == 4){
				var offer_salary = $(this).parent().parent().find('.offer_salary').text();
				var joining_date = $(this).parent().parent().find('.joining_date').text();
				if(offer_salary == '' || joining_date == ''){
					alert('please Enter Offer Salart And Joining Date');
					$(this).val('3');
					return false;
				}
			}
			$('#overlay').show();
			$.ajax({
			  type: "POST",
			  url: "{{route('admin.change_status')}}",
			  cache: false,
			  data : {
			  	"id" : id,
			  	"status" : status,
			  	"_token":"{{ csrf_token() }}"
			  },
			  dataType: "json",
			  success: function(response){
			  	if(response.status == 1){
			  		$('#overlay').hide();
			  		location.reload();
			  	}else{
			  		alert('something wents wrongs');
			  		$('#overlay').hide();
			  		location.reload();
			  	}
			  }
			});
		});
	});
</script>

@endsection