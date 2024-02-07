@extends('layouts.mainLayout')

@section('title','Memo Publics')
@section('style')
<link rel="stylesheet" href="{{asset('css/memo.css')}}">
@endsection

@section('content')
	<h1>Memo publics :</h1>
	<div class="memos-container">
		@forelse ($memos as $memo)
			<div class="memo">
				<section>
					<h3><a href="{{ route('memo_detaille',['memo' => $memo]) }}">{{ $memo->title }}</a></h3>
					<p> Publié par : {{$memo->owner }}<p>
					<p>Date : {{ $memo->created_at }}</p>
				</section>
				<hr>
			</div>
		@empty
			<p>No memo.</p>
		@endforelse
	</div>
	@include('shared.message')
	<p>
		Go back to <a href="{{ route('view_signin') }}">Connexion</a>.
	</p>
@endsection

