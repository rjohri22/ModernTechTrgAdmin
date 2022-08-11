@extends('admin.layout.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="box box-primary container mt-2" style="background: white">

	<div class="box-header">
		<h3> Band Permission</h3>
	</div>
    



<body>

<h1></h1>
<div class="card container">
    <div class="card-body">
<table class="table table-condensed">
<thead class="thead-dark" >
  <tr>
    <th scope="col" style="width: 10%; ">Module Name</th>
    <th scope="col" style="width: 10%; ">Permission name</th>
    <th scope="col" style="width: 10%;">Index</th>
    <th scope="col" style="width: 10%; ">View</th>
    <th scope="col" style="width: 10%; ">Edit</th>
    <th scope="col" style="width: 10%; ">Delete</th>
  </tr>

  <tr>
    <td>Recruitment </td>
    <td>Job description </td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
  </tr>
  <tr>
    <td>Recruitment </td>
    <td>Job  </td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
  </tr>
  <tr>
    <td>Recruitment </td>
    <td>Approved Job  </td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
  </tr>
  <tr>
    <td>Master </td>
    <td> Groups  </td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
  </tr>
  <tr>
    <td>Master </td>
    <td> Departments  </td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
  </tr>
  <tr>
    <td>Master </td>
    <td>Designantion </td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
  </tr>
  <tr>
    <td>Master </td>
    <td>States </td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
  </tr>
  <tr>
    <td>Master </td>
    <td>Cities </td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
    <td><input type="checkbox"></td>
  </tr>
</table>

<div>
   
</div>
<div class="row">

<input class="btn btn-primary" style="float:center;" type="submit" value="submit" >
</div>

<br>
</div>
</body>
@endsection