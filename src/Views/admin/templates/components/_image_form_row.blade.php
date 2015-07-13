<div class="form-group">
	{!! Form::label('cp_'.$component->id, $component->title, ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
	   {!! Form::file('cp_'.$component->id, '',array('id'=>'image','class'=>'form-control')) !!}
        @if($cp && $thumbUrl)
            <div class="image-preview"><img src="{{ asset($thumbUrl) }}" /></div>
            <div class="image-removal">{!! Form::checkbox('remove_image', $cp->id, null) !!} remove existing image</div>
        @endif
    </div>
</div>