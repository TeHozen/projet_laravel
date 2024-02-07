@extends('layouts.mainLayout')

@section('title','Signin')
@section('style')
	<link rel="stylesheet" href="{{asset('css/signin.css')}}">
@endsection

@section('content')
	<div class="center">
		<h1>Signin</h1>
		<form action="{{ route('user_authenticate') }}" method="post">
			@csrf
			<label for="login">Login</label>      <input type="text"     id="login"    name="login"    required autofocus>
			<label for="password">Password</label><input type="password" id="password" name="password" required>
			<input type="submit" value="Signin">
		</form>
		<p>
			If you don't have an account, <a href="{{ route('view_signup') }}">signup</a> first.
		</p>
		@include('shared.message')
		<p>
			Voir mémos publics : <a href="{{ route('view_memopublic') }}">Memos publics</a>
		</p>
	</div>
@endsection
