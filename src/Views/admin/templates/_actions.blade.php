<a href="{{ route('admin.pages.templates.build', $template->id) }}">
	<button type="button" class="btn btn-info btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Edit/Build Template">
		<i class="fa fa-pencil-square-o"></i>
	</button>
</a>



{!! Form::model($template, ['data-remote' => true, 'data-callback' => 'removeTableRow', 'class' => 'remote-form', 'route' => ['admin.pages.templates.delete', $template->id]]) !!}
	<a href="#">
		<button type="button" class="btn btn-danger btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Delete Template" 
				onclick="customConfirm( this, 'Are you sure?', 'You will not be able to recover its page data (if any).', 'Deleted!', 'The template has been deleted.')" >
			<i class="fa fa-trash-o"></i>
		</button>
	</a>
{!! Form::close() !!}