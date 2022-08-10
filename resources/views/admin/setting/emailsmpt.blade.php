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
					<input type="text" name="smtp_host" id="smtp_host" value="{{ $smtp->smtp_host}}" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Username</label>
					<input class="form-control" name="username" value="{{ $smtp->smtp_username}}" id="username">
</input>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Password</label>
					<input class="form-control" name="password" value="{{ $smtp->smtp_password}}" id="password">
</input>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>SMTP Port</label>
					<input class="form-control" name="smtp_port" value="{{ $smtp->smtp_port}}" id="smtp_port">
</input>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label>Mail Encryption </label>
					<select class="form-control" name="mail_encryption" id="mail_encryption">
						<option value="TLS" @if ($smtp->smtp_mail_encryption == 'TLS') selected @endif >TLS</option>
						<option value="SSL" @if ($smtp->smtp_mail_encryption == 'SSL') selected @endif >SSL</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<label> Mail From Name</label>
					<input class="form-control" value="{{ $smtp->smtp_mail_from_name}}" name="mail_from_name" id="mail_from_name">
</input>
				</div>
			</div>
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
