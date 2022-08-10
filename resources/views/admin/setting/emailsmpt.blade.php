@extends('admin.layout.master')
@section('content')

<div class="box box-primary container mt-2" style="background: white">
	<div class="box-header with-border">
		<h3>Email SMTP Setting</h3>
	</div>
	<div class="box-body">
	<form action="{{route('admin.store_setting')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<label>SMTP Host</label>
					<input type="text" name="smtp_host" id="smtp_host" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Username</label>
					<input class="form-control" name="username" id="username">
</input>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Password</label>
					<input class="form-control" name="password" id="password">
</input>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>SMTP Port</label>
					<input class="form-control" name="smtp_port" id="smtp_port">
</input>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Mail Encryption </label>
					<select class="form-control" name="mail_encryption" id="mail_encryption">
						<option value="TLS">TLS</option>
						<option value="SSL">SSL</option>
						<option value="Null">Null</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label> Mail From Name</label>
					<input class="form-control" name="mail_from_name" id="mail_from_name">
</input>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-sm-4">
					<label> Date</label>
					<input class="form-control" type="date" name="mail_from_name" id="mail_from_name">
</input>
				</div>
			</div> -->
			<br>
			<div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" type="submit">Save</button>
				</div>
			</div>
			<br>
		</form>
	</div>
</div>
@endsection
