@extends('layouts.splash')

@section('title')
	503
@endsection

@section('content')
	<div class="container">
		<div class="content">
			<div class="title">{!! trans('page_errors.503.error') !!}</div>
			<h4 class="sub-ttl">{!! trans('page_errors.503.message') !!}</h4>
		</div>
	</div>
@endsection
