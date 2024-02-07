@extends('layouts.mainLayout')

@section('title','Memo list')
@section('style')
<link rel="stylesheet" href="{{asset('css/memo.css')}}">
@endsection

@section('content')
	<h1>Your memo list</h1>
	<div class="memos-container">
		@forelse ($memos as $memo)
			<div class="memo">
				<section>
					<h3>Titre : {{ $memo->title }}</h3>
					<p>Content : {{ $memo->content }}</p>
					<p> Public : {{ $memo->is_public ? 'oui' : 'non'}}</p>
					<p>Date de création : {{$memo->created_at}}</p>
					<p>Date de denière modification : {{$memo->updated_at}}</p>
				</section>
				<a href="{{ route('memo_delete',['memo' => $memo]) }}">Supprimer le mémo</a><br>
				<a href="{{ route('memo_change_status',['memo' => $memo]) }}">Changer le status</a><br>
				<a href="{{ route('memo_formupdate',['memo' => $memo]) }}">Modifier le memo</a>
				<hr>
			</div>
		@empty
			<p>No memo.</p>
		@endforelse
	</div>
	@include('shared.message')
	<p>
		Go back to <a href="{{ route('view_account') }}">Home</a>.
	</p>
@endsection
