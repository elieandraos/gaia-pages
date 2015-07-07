<script type="text/javascript">
window.onload = function ()
{
	/*alert('s');

	bkLib.onDomLoaded(function() {
	new nicEditor().panelInstance( "{!! 'cp_'.$component->id !!}");
	//new nicEditor({fullPanel : true}).panelInstance('area2');
	//new nicEditor({iconsPath : '/img/nicEditorIcons.gif'}).panelInstance('area3');
	//new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
	//new nicEditor({maxHeight : 100}).panelInstance('area5');
	});*/
}


</script>

<div class="form-group">
	{!! Form::label('cp_'.$component->id, $component->title, ['class' => 'col-sm-3 control-label']) !!}
	<div class="col-sm-6">
    	{!! Form::textarea('cp_'.$component->id, $value, ['class' => 'form-control richtexteditor', 'rows' => 3]) !!}
	</div>
</div>