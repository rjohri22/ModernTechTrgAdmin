@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
  .table label {
    /*float:left;*/
    margin-right: 10px;
  }
</style>

<div class="page-wrapper mdc-toolbar-fixed-adjust">
  
<form action="{{route('admin.bend_permission_update',$id)}}" method="post">
  @csrf
  <main class="content-wrapper">

    <div class="mdc-card info-card info-card--success">
      <div class="card-inner">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="card-title d-inline">Permissions</h5>
             <div class="filter" style="display: inline; float: right; width: 500px">
              <select class="form-control" id="filter">
                <option value="">All Modules</option>
                @foreach($modules as $p)
                    <option value="{{$p->module_name}}">{{$p->module_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
      <thead>
        <tr>
          <th class="text-left">Module Name</th>
          <th>Permission name</th>
          <th><label ><input type="checkbox" class="check_all" data-class="index" ></label> Index</th>
          <th><label><input type="checkbox" class="check_all" data-class="view" ></label> View</th>
          <th><label><input type="checkbox" class="check_all" data-class="add" ></label> Add</th>
          <th><label><input type="checkbox" class="check_all" data-class="edit" ></label> Edit</th>
          <th><label><input type="checkbox" class="check_all" data-class="delete" ></label> Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach($permissions as $p)
        @php
          $module_name = str_replace(' ','_',$p->module_name);
        @endphp
        <tr class="row_{{$module_name}} all_class">
          <th>{{ $p->module_name }}</th>
          <td> {{ $p->option_name }} &nbsp;<label ><input type="checkbox" class="check_all" data-class="{{ $p->option_slug }}" style="text-align: right"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_index' }}" @if($p->_index) checked @endif class="index {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_view' }}" @if($p->_view) checked @endif class="view  {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_add' }}" @if($p->_add) checked @endif class="add  {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_edit' }}" @if($p->_edit) checked @endif class="edit  {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_delete' }}" @if($p->_delete) checked @endif class="delete  {{ $p->option_slug }}" ></label></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <button class="btn btn-primary" style="float: right;" >Save</button>
      </div>
    </div>
  </main>
</form>
</div>


<!-- <div class="box box-primary container mt-2" style="background: white">
  <form action="{{route('admin.bend_permission_update',$id)}}" method="post">
  @csrf
	<div class="box-header">
		<h3 style="display: inline">Permissions</h3>
    <div class="filter" style="display: inline; float: right; width: 500px">
      <select class="form-control" id="filter">
        <option value="">All Modules</option>
        @foreach($modules as $p)
            <option value="{{$p->module_name}}">{{$p->module_name}}</option>
        @endforeach
      </select>
    </div>
	</div>
  <br>
	<div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th>Module Name</th>
          <th>Permission name</th>
          <th><label ><input type="checkbox" class="check_all" data-class="index" ></label> Index</th>
          <th><label><input type="checkbox" class="check_all" data-class="view" ></label> View</th>
          <th><label><input type="checkbox" class="check_all" data-class="add" ></label> Add</th>
          <th><label><input type="checkbox" class="check_all" data-class="edit" ></label> Edit</th>
          <th><label><input type="checkbox" class="check_all" data-class="delete" ></label> Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach($permissions as $p)
        @php
          $module_name = str_replace(' ','_',$p->module_name);
        @endphp
        <tr class="row_{{$module_name}} all_class">
          <th>{{ $p->module_name }}</th>
          <td><label ><input type="checkbox" class="check_all" data-class="{{ $p->option_slug }}" ></label> {{ $p->option_name }}</td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_index' }}" @if($p->_index) checked @endif class="index {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_view' }}" @if($p->_view) checked @endif class="view  {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_add' }}" @if($p->_add) checked @endif class="add  {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_edit' }}" @if($p->_edit) checked @endif class="edit  {{ $p->option_slug }}"></label></td>
          <td><label ><input type="checkbox" name="{{ $p->option_slug.'_delete' }}" @if($p->_delete) checked @endif class="delete  {{ $p->option_slug }}" ></label></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    <button class="btn btn-primary" style="float: right;" >Save</button>
  </div>
  </form>
</div> -->
<script>
  $(document).ready(function(){
    $('.check_all').click(function(){
      $('.'+$(this).data('class')).prop('checked', $(this).prop("checked"));
    });

    $('#filter').change(function(){
      var modules = $(this).val();
      var modules = modules.replace(' ','_');
      if(modules != ''){
        $('.all_class').hide();
        $(`.row_${modules}`).show();
      }else{
        $('.all_class').show();
      }
    });
  });
</script>
@endsection