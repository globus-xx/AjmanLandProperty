<div class="well-bordered form">
<h2  style="display:inline-block;">Attached Documents</h2>
<a style="display:inline-block;" href="javascript:void(0)" class="toggle-attach-a-document" >Attach a Document?</a>
<div class="well document-attachinary-holder" style="display:none;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documentable-form',
	'enableAjaxValidation'=>false,
  'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Document To Attach'); ?>
		<small>Type to search for the document you wish to attach</small><br/>
		<input id="search_for_document" />
		<?php echo $form->hiddenField($model,'documentId'); ?>
		<?php echo $form->error($model,'documentId'); ?>
		<?php echo $form->hiddenField($model,'documentable_type'); ?>
		<?php echo $form->hiddenField($model,'documentable_id'); ?>
		<a id="link-attach-document-to-element" href="javascript:void(0)">Attach Document</a> |
		<small><a href="javascript:void(0)" class="toggle-hide-attach-a-document" >Cancel</a></small>
	</div>

<?php $this->endWidget(); ?>
</div>
<ul>
	<?php
	 foreach($documentables as $documentable):?>
	<li>
		<?php echo ($documentable->document->attributes['title']);?>
		<a href="<?php echo Yii::app()->createUrl('document/download', array('id'=>$documentable->document->id));?>">Download</a>
		<a class="link-to-detach-document" href="javascript:void(0)" data-id="<?php echo $documentable->attributes['id'];?>">Detach</a>
	</li>
<?php endforeach;?>
</ul>

</div><!-- form -->
<script language="javascript">
  $(function(){
  	$('.toggle-attach-a-document').click(function(){
  		$('.document-attachinary-holder').show();
  	});
  	$('.toggle-hide-attach-a-document').click(function(){
  		$('.document-attachinary-holder').hide();
  	});
  	$('.link-to-detach-document').click(function(){
  		var _this = $(this);
  		$.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Documentable/Delete",
            data: { id:$(this).attr('data-id')},
            success: function(data) {
            	$(_this).parents('li').remove();
            }
        });
  	});
  	$('#link-attach-document-to-element').click(function(){
  		form = $(this).parents('form').first();
  		datastring = $(form).serialize();

  		$.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Documentable/Create",
            data: datastring,
            success: function(data) {
            	$('#link-attach-document-to-element').parents('.form').first().replaceWith(data);
            }
        });
  	});
	 $( "#search_for_document" ).autocomplete({
		source: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Document/Search",
		minLength: 2,
		focus: function( event, ui ) {
			$("#search_for_document").val( ui.item.title );
			return false;
		},
		select: function( event, ui ) {
			$("#search_for_document").val(ui.item.title);
			$("#Documentable_documentId").val( ui.item.id );
			return false;
		  }
		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li>" )
			.append( "<a>" + item.title + "<br>" + item.fileName + "</a>" )
			.appendTo( ul );
		};
	});
  
</script>