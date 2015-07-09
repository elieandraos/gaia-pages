@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Pages</li>
		    <li class="active">Edit</li>
		</ul>

		<h1 class="h1">{{ $page->title}} | Edit</h1>
	</div>
</div>

{!! Form::model( $page, ['route' => ['admin.pages.update', $page->id], 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
<div class="row">
	<div class="col-md-12">
		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">General Info</h3>
			</div>
			<div class="panel-body">

				@include('admin.form-errors')

				<div class="form-group @if($errors->has('title')) has-error @endif">
					{!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
		            <div class="col-sm-3">
		                {!! Form::text('title', (isset($page))?$page->title:null, ['class' => 'form-control slug-target']) !!}
		            </div>
		            <div class="col-sm-3">
		                {!! Form::text('slug', (isset($page))?$page->slug:null, ['class' => 'form-control txt-slug', 'placeholder' => 'URL slug']) !!}
		            </div>
		        </div>

{{-- 		        <div class="form-group @if($errors->has('description')) has-error @endif">
					{!! Form::label('description', 'Content', ['class' => 'col-sm-3 control-label']) !!}
		            <div class="col-sm-6">
		                {!! Form::textarea('description', (isset($page))?$page->description:null, ['class' => 'form-control']) !!}
		            </div>
		        </div>  --}}
			</div>
		</div>
		<!-- Panel end -->	


		<!-- Components and Sections from template -->	
		@foreach($sections as $section)
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{{ $section->title }}</h3>
				</div>
				<div class="panel-body">
					@foreach($section->getComponentsByOrder() as $component)
							{!! $component->renderFormRow($page->id) !!} 
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
</div>

@include('admin.seo._form')

<div class="row">
    <div class="col-sm-1  col-sm-push-5">
        <a href="{{ route('admin.pages.index') }}">
            <button type="button" class="btn btn-default btn-trans btn-full-width" data-toggle="tooltip" data-placement="top" title="Back to pages list">
                <i class="fa fa-mail-reply"></i> &nbsp; Pages List
            </button>
        </a>
    </div>
    <div class="col-sm-1 col-sm-push-5">
        {!! Form::submit('Save', ['class' => 'btn btn-primary btn-trans form-control']) !!}
    </div>
</div>
{!! Form::close() !!}
@stop