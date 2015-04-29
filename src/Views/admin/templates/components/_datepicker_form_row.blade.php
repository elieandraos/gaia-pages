<div class="form-group @if($errors->has('published_at')) has-error @endif">
	{!! Form::label('cp_'.$component->id, $component->title, ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        <div class="input-group date">
          {!! Form::text('cp_'.$component->id, null, ['class' => 'form-control']) !!}
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>  
    </div>
</div>      