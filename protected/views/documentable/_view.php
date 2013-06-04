<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documentable-form',
	'enableAjaxValidation'=>false,
  'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Document To Attach'); ?>
		<input id="search_for_document" />
		<?php echo $form->hiddenField($model,'documentId'); ?>
		<?php echo $form->error($model,'documentId'); ?>
		<?php echo $form->hiddenField($model,'documentable_type'); ?>
		<?php echo $form->hiddenField($model,'documentable_id'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script language="JavaScript">
  $(function(){
    $('#search_for_document').keydown(function(){
      $.ajax({
        url:'<?php echo Yii::app()->request->baseUrl;?>/index.php/Document/FormDocumentType',
        data:{documentTypeId:$(this).val()}
      }).done(function(response){
        $('#document-subform-container').html(response);
      });
    });
  });

  $( "#search_for_document" ).autocomplete({
	source: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Document/Search",
	minLength: 2,
	select: function( event, ui ) {
		log( ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value );
	  }
	});
});
  
</script>