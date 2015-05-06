@extends('admin.layout')

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- Breadcrumb -->
		<ul class="breadcrumb">
		    <li><a href="#">Dashboard</a></li>
		    <li>Pages</li>
		    <li class="active">List</li>
		</ul>


		<!-- Panel start -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Pages List</h3>
			</div>
			<div class="panel-body">
				<!-- News List -->
				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th>Title</th>
				      <th>Template</th>
				      <th>Action</th>
				    </tr>
				  </thead>
				  <tbody>
				    @foreach($pages as $page)
						<tr>
							<td>{{ $page->title }}</td>
							<td>{{ $page->template->title }}</td>
							<td>
								@include('admin.pages._actions', ['page' => $page])
							</td>
						</tr>
					@endforeach
				  </tbody>
				</table>

				<div class="centered">
					
				</div>
			</div>
		</div>
		<!-- Panel end -->
	</div>
</div>

@stop