@extends('layouts.mainLayout')

@section('title','Account')
@section('style')
<link rel="stylesheet" href="{{asset('css/account.css')}}">
@endsection

@section('content')
	<div class="account-container">
		<h2>
			Hello {{ session('user')->login }} !<br>
			Welcome on your account.
		</h2>
		<ul>
			<li><a href="{{ route('view_formpassword') }}">Change password.</a></li>
			<li><a href="{{ route('user_deleteuser') }}">Delete my account.</a></li>
		</ul>
		<ul>
			<li><a href="{{ route('view_formmemo') }}">Add a memo.</a></li>
			<li><a href="{{ route('memo_show') }}">Show all memos.</a></li>
		</ul>
		@include('shared.message')
		<p><a href="signout">Sign out</a></p>
	</div>
@endsection
