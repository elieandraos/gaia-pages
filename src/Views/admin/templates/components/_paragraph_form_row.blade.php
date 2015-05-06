<div class="form-group">
	{!! Form::label('cp_'.$component->id, $component->title, ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-6">
    	{!! Form::textarea('cp_'.$component->id, $value, ['class' => 'form-control', 'rows' => 3]) !!}
	</div>
</div>