<div class="form-group @if($errors->has('published_at')) has-error @endif">
	{!! Form::label('cp_'.$component->id, $component->title, ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
          {!! Form::select('cp_'.$component->id, $options, null,[ 'class' => '']) !!}
    </div>
</div>  