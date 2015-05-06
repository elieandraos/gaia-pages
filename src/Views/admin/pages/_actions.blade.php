<a href="{{ route('admin.pages.edit', $page->id) }}">
	<button type="button" class="btn btn-info btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Edit Page">
		<i class="fa fa-pencil-square-o"></i>
	</button>
</a>

{!! Form::model($page, ['data-remote' => true, 'data-callback' => 'removeTableRow', 'class' => 'remote-form', 'route' => ['admin.pages.delete', $page->id]]) !!}
	<a href="#">
		<button type="button" class="btn btn-danger btn-trans btn-xs btn-action " data-toggle="tooltip" data-placement="top" title="Delete Page" 
				onclick="customConfirm( this, 'Are you sure?', 'You will not be able to recover its data.', 'Deleted!', 'The page has been deleted.')" >
			<i class="fa fa-trash-o"></i>
		</button>
	</a>
{!! Form::close() !!}