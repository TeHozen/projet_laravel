@extends('layouts.mainLayout')

@section('title','Add memo')
@section('style')
<link rel="stylesheet" href="{{asset('css/signin.css')}}">
@endsection

@section('content')
	<div class="center">
		<h1>Add a memo</h1>
		<form action="{{ route('memo_add') }} " method="post">
			@csrf
			<label for="title">Title:</label> <input type="text" id="title" name="title" required><br>
			<label for="content">Content:</label><br>
			<textarea id="content" name="content" rows="8" cols="60"></textarea><br>
			<input type="submit" value="Save">
		</form>
		<p>
			Go back to <a href="{{ route('view_account') }}">Home</a>.
		</p>
		@include('shared.message')
	</div>
@endsection
