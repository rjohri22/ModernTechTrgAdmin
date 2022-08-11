@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
  .table label {
    float:left;
    margin-right: 10px;
  }
</style>
<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header">
		<h3>Permissions</h3>
	</div>
	<div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th>Module Name</th>
          <th>Permission name</th>
          <th><label ><input type="checkbox" class="check_all" data-class="index" ></label> Index</th>
          <th><label><input type="checkbox" class="check_all" data-class="view" ></label> View</th>
          <th><label><input type="checkbox" class="check_all" data-class="edit" ></label> Edit</th>
          <th><label><input type="checkbox" class="check_all" data-class="delete" ></label> Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach($permissions as $p)
        <tr>
          <th>{{ $p->module_name }}</th>
          <td><label ><input type="checkbox" class="check_all" data-class="{{ $p->option_slug }}" ></label> {{ $p->option_name }}</td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_index' }}" class="index {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_view' }}" class="view  {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_edit' }}" class="edit  {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_delete' }}" class="delete  {{ $p->option_slug }}" ></label></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    <button class="btn btn-primary" style="float: right;" >Save</button>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('.check_all').click(function(){
      $('.'+$(this).data('class')).prop('checked', $(this).prop("checked"));
    });
  });
</script>
@endsection