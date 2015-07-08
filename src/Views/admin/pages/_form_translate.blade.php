<!-- Panel start -->

<div class="row">
    <div class="col-md-2 col-md-push-10">
        <div class="form-group" style="text-align:right;margin-right:0">
            Translating to: {!! Form::select('locale', $locales, $locale, ['class' => 'form-control toggle-language', 'style' => 'width: auto;display:inline']) !!}
            <input type="hidden" value="{!! route('admin.pages.translate', [$page->id, null]) !!}" id="translate-url" />
        </div>
    </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Required Info</h3>
	</div>
	<div class="panel-body">

		@include('admin.form-errors')

		<div class="form-group @if($errors->has('title')) has-error @endif">
			{!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('title', $page->title, ['class' => 'form-control slug-target']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::text('slug', $page->slug, ['class' => 'form-control txt-slug', 'placeholder' => 'URL slug']) !!}
            </div>
        </div>

        <div class="form-group @if($errors->has('description')) has-error @endif">
			{!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::textarea('description', $page->description, ['class' => 'form-control']) !!}
            </div>
        </div>  
	</div>
</div>
<!-- Panel end -->


<!-- Components and Sections from template -->  
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Translatable</h3>
    </div>
    <div class="panel-body">
        @foreach($sections as $section)
            @foreach($section->getComponentsByOrder() as $component)
                @if(in_array($component->component_type_id, [1,2,8]))
                    {!! $component->renderFormRow($page->id) !!} 
                @endif
            @endforeach
        @endforeach
    </div>
</div>

@include('admin.seo._form')

<div class="row">
    <div class="col-sm-1  col-sm-push-5">
        <a href="{{ route('admin.pages.index') }}">
            <button type="button" class="btn btn-default btn-trans btn-full-width" data-toggle="tooltip" data-placement="top" title="Back to pages list">
                <i class="fa fa-mail-reply"></i> &nbsp; Pages
            </button>
        </a>
    </div>
    <div class="col-sm-1 col-sm-push-5">
        {!! Form::submit('Save page', ['class' => 'btn btn-primary btn-trans form-control']) !!}
    </div>
</div>