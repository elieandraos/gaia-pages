
<div class="form-group @if($errors->has('published_at')) has-error @endif">
	{!! Form::label('cp_'.$component->id, $component->title, ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-3">
        @foreach($options as $key => $option)
          {!! Form::checkbox('cp_'.$component->id.'[]', $component->title, null,[ 'class' => '']) !!}
          {!! trim($option) !!}
          <br/>
        @endforeach  
    </div>
</div>      