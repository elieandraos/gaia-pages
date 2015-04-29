@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Pages</li>
		    <li class="active">Create</li>
		</ul>

		<h1 class="h1">Create New Page</h1>
	</div>
</div>

{!! Form::open(['route' => 'admin.pages.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}
<div class="row">
	<div class="col-md-12">
		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Required Info</h3>
			</div>
			<div class="panel-body">
				@include('admin.form-errors')
				<div class="form-group @if($errors->has('title')) has-error @endif">
					{!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
		            <div class="col-sm-6">
		                {!! Form::text('title', null, ['class' => 'form-control slug-target']) !!}
		            </div>
		        </div> 
				<div class="form-group @if($errors->has('template_id')) has-error @endif">
					{!! Form::label('template_id', 'Template', ['class' => 'col-sm-3 control-label']) !!}
		            <div class="col-sm-6">
		                {!! Form::select('template_id', $templates, null, ['class' => 'form-control']) !!}
		            </div>
		        </div> 
		        	
		        <div class="form-group">
		        	<div class="col-sm-1 col-sm-push-5">
						{!! Form::submit('Save', ['class' => 'btn btn-primary btn-trans form-control']) !!}
				    </div>
		        </div>
			</div>
		</div>
		<!-- Panel end -->
	</div>
</div>

{!! Form::close() !!}

@stop