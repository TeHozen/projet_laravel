@extends('layouts.mainLayout')

@section('title','Change password')
@section('style')
<link rel="stylesheet" href="{{asset('css/signin.css')}}">
@endsection

@section('content')
	<div class="center">
		<h1>Change password</h1>
		<form action="{{ route('user_changepassword') }} " method="post">
			@csrf
			<label for="newpassword">New password</label>        <input type="password" id="newpassword"	 name="newpassword"	 required>
			<label for="confirmpassword">Confirm password</label><input type="password" id="confirmpassword" name="confirmpassword" required>
			<input type="submit" value="Change my password">
		</form>
		<p>
			Go back to <a href="{{ route('view_account') }}">Home</a>.
		</p>
		@include('shared.message')
	</div>
@endsection
