@extends('layouts.mainLayout')

@section('title','Memo list')
@section('style')
<link rel="stylesheet" href="{{asset('css/memo.css')}}">
@endsection

@section('content')
	<h1>Memo détaillé</h1>
	<div class="memo">
		<section>
			<h3>Titre : {{ $memo->title }}</h3>
			<p> Publié par : {{$memo->owner }}<p>
			<p>Content : {{ $memo->content }}</p>
			<p> Public : {{ $memo->is_public ? 'oui' : 'non'}}</p>
			<p>Date de création : {{$memo->created_at}}</p>
			<p>Date de denière modification : {{$memo->updated_at}}</p>
		</section>
		<hr>
	</div>
	@include('shared.message')
	<p>
		Go back to <a href="{{ route('view_memopublic') }}">Memo publics</a>.
	</p>
@endsection
