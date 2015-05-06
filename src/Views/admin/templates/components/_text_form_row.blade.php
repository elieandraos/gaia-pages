<div class="form-group">
	{!! Form::label('cp_'.$component->id, $component->title, ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-6">
    	{!! Form::text('cp_'.$component->id, $value, ['class' => 'form-control']) !!}
	</div>
</div>