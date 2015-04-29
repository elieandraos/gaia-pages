@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Pages</li>
		    <li>Templates</li>
		    <li class="active">List</li>
		</ul>


		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Page Templates</h3>
			</div>
			<div class="panel-body">
				<!-- News List -->
				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($templates as $template)
						<tr>
							<td>{{ $template->title }}</td>
							<td>
								@include('admin.templates._actions', ["template" => $template])
							</td>
						</tr>
					@endforeach
				  </tbody>
				</table>

				<div class="centered">
					{!! $templates->render() !!}
				</div>
			</div>
		</div>
		<!-- Panel end -->
	</div>
</div>

@stop