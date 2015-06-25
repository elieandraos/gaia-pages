@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Pages</li>
		    <li class="active">Translate</li>
		</ul>

		<h1 class="h1">Translate Page</h1>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		{!! Form::model( $page, ['route' => ['admin.pages.translate-store', $page->id, $locale], 'class' => 'form-horizontal', 'role' => 'form']) !!}
			@include('admin.pages._form_translate', ['locale' => $locale])
		{!! Form::close() !!}
	</div>
</div>

@stop