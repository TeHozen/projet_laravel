@extends('layouts.mainLayout')

@section('title','Signup')

@section('style')
<link rel="stylesheet" href="{{asset('css/signin.css')}}">
@endsection

@section('content')
	<div class="center">
		<h1>Signup</h1>
		<form action="{{ route('user_adduser') }}" method="post">
			@csrf
			<label for="login">Login</label>             <input type="text"     id="login"    name="login"    required autofocus>
			<label for="password">Password</label>       <input type="password" id="password" name="password" required>
			<label for="confirm">Confirm password</label><input type="password" id="confirm"  name="confirm"  required>
			<input type="submit" value="Signup">
		</form>
		<p>
			If you already have an account, <a href="{{ route('view_signin') }}">signin</a>.
		</p>
		@include('shared.message')
	</div>
@endsection
